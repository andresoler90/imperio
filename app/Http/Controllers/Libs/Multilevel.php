<?php

namespace App\Http\Controllers\Libs;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Rank;
use App\Models\UserBalance;
use App\Models\UserMembership;
use App\Models\UserMultilevel;
use App\Models\UserScore;
use App\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Multilevel extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Obtiene el todos los referidos directos e indirectos en un array
     * @param int $deep
     * @return mixed
     */
    public function under()
    {
        $flag = true;
        $nodes[0] = UserMultilevel::where('parent_users_id', $this->user->id)->get()->pluck('users_id');
        $i = 1;
        while ($flag) {

            $data = UserMultilevel::whereIn('parent_users_id', $nodes[$i - 1])->get()->pluck('users_id');

            if (count($data)) {
                $nodes[$i] = $data;
                $i++;
            } else {
                $flag = false;
            }
        }

        return $nodes;
    }

    /**
     * Retorna todos los nodos que se encuentren por debajo del hijo izquierdo
     * @param int $deep
     * @return mixed
     */
    public function underLeftNode($deep = 100)
    {
        //Ubicamos los hijos del usuario dentro del binario
        $userMutilevel = $this->user->userMultilevel;
        if ($userMutilevel) {
            $childs = $userMutilevel->hasChilds;
            if (count($childs)) {
                //Filtramos la posicion derecha
                $childLeft = $childs->where('position', 'I')->first();
                if ($childLeft) {
                    //Consultamos todos los nodos por debajo de este usuario
                    $multilevel = new Multilevel($childLeft->user);
                    return $multilevel->underPlain();
                }
            }
        }
        return collect([]);
    }

    /**
     * Retorna todos los nodos que se encuentren por debajo del hijo derecho
     * @param int $deep
     * @return mixed
     */
    public function underRightNode($deep = 100)
    {
        //Ubicamos los hijos del usuario dentro del binario
        $userMutilevel = $this->user->userMultilevel;
        if ($userMutilevel) {
            $childs = $userMutilevel->hasChilds;
            if (count($childs)) {
                //Filtramos la posicion derecha
                $childRight = $childs->where('position', 'D')->first();
                if ($childRight) {
                    //Consultamos todos los nodos por debajo de este usuario
                    $multilevel = new Multilevel($childRight->user);
                    return $multilevel->underPlain();
                }
            }
        }
        return collect([]);
    }

    /**
     * Trae una coleccion solo con los registros
     * @param int $deep
     * @return \Illuminate\Support\Collection
     */
    public function underPlain()
    {

        $levels = $this->under();
        $arr = [];
        foreach ($levels as $level) {
            foreach ($level as $node) {
                $arr[] = UserMultilevel::where('users_id', $node)->first();
            }
        }

        if ($arr)
            return collect($arr)->sortBy('parent_users_id');
        else
            return collect([]);
    }

    /**
     * Retorna la proxima posicion disponible en el binario
     * @param string $position
     * @return object
     */
    public function nextEmpty($position = '')
    {

        $userMultilevel = $this->user->userMultilevel;
        if ($userMultilevel) {
            $childs = $userMultilevel->hasChilds;
            $positionNode = $childs->where('position', $position)->first();
            //Verificamos si tenemos una posicion disponible en el primer nivel del binario en la posicion que desea el usuario
            if (!$positionNode) {
                return (object)[
                    'parent_users_id' => $this->user->id,
                    'position'        => $position,
                ];
            } else {
                //Si ya esta cubierto el primer nivel procedemos a listar los usuario por debajo del primer nivel del lado seleccionado por el usuario
                $multilevel = new Multilevel($positionNode->user);

                //Obtenemos todos los nodos en forma de lista
                $multilevel = $multilevel->underPlain()->where('position', $position);

                //Verifico si el hijo tiene nodos
                if (count($multilevel)) {

                    //En caso de no tener disponible ninguno procesemos a crear un nuevo nivel

                    $lastId = null;
                    //Recorremos la lista de nodos y verificamos cuando no tiene hijos
                    foreach ($multilevel as $node) {
                        //Verifico si este nodo tiene algun lado disponible
                        if (count($node->hasChilds) < 2) {
                            //Verifico si el lado ocupado es el mismo que estoy buscando
                            $nodeChild = $node->hasChilds->where('position', $position)->first();
                            $parentPosition = $node->parent->position;
                            //Si no ha sido ocupado retorno el id del padre
                            // Y si es el lado mas extremo
                            if (!$nodeChild && $parentPosition == $position) {
                                $lastId = $node->users_id;
                                break;
                            }
                        }
                    }

                    if (!$lastId) {
                        $lastId = $this->user->id;
                    }
                    //Dependiendo de lo indicado del usuario se trata de ubicar el lado de preferencia
                    switch ($position) {
                        case 'D':
                            $data = [
                                'parent_users_id' => $lastId,
                                'position'        => 'D',
                            ];
                            break;

                        case 'I':
                            $data = [
                                'parent_users_id' => $lastId,
                                'position'        => 'I',
                            ];
                            break;

                        default:
                            $temp = Factory::create();
                            $char = $temp->randomElement(['D', 'I']);
                            $data = [
                                'parent_users_id' => $lastId,
                                'position'        => $char,
                            ];

                    }
                } else {
                    //Si no hay ningun nodo por debajo creo un nuevo nivel
                    return (object)[
                        'parent_users_id' => $positionNode->user->id,
                        'position'        => $position,
                    ];
                }
            }
        }
        return (object)$data;
    }

    public function upper($deep = 1)
    {
        for ($i = 1; $i <= $deep; $i++) {
            if ($i == 1) {
                $nodes[$i] = $this->user->userMultilevel->parent;

                if (!$nodes[$i]) {
                    break;
                }
            } else {
                $sponsor_id = $nodes[$i - 1]->parent_users_id;
                $data = UserMultilevel::where('users_id', $sponsor_id)->where('users_id', '!=', $this->user->id)->first();
                if ($data) {
                    $nodes[$i] = $data;
                } else {
                    break;
                }
            }
        }
        return $nodes;
    }

    /**
     * Trae todos los nodos izquierdos del lado izquierdo del binario
     * @return \Illuminate\Support\Collection
     */
    public function totalLeft($dateStart = null, $dateEnd = null)
    {
        if (!$dateStart)
            $dateStart = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        if (!$dateEnd)
            $dateEnd = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $multilevel = $this->underPlain();
        if ($multilevel) {
            return $multilevel->where('position', 'I')->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd);
        }
        return null;
    }

    /**
     * Trae todos los nodos derecho del lado derecho del binario
     * @return \Illuminate\Support\Collection
     */
    public function totalRight($dateStart = null, $dateEnd = null)
    {
        if (!$dateStart)
            $dateStart = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        if (!$dateEnd)
            $dateEnd = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $multilevel = $this->underPlain();
        if ($multilevel) {
            return $multilevel->where('position', 'D')->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd);
        }
        return null;
    }

    public function totalPfAndPd(): array
    {
        $start = date('Y-m-01');
        $end = date('Y-m-D');
        $left = $this->volumeNode('I', $start, $end);
        $right = $this->volumeNode('D', $start, $end);

        if ($left && $right) {
            if ($left >= $right) {
                $result['pf'] = $left;
                $result['pd'] = $right;
            } else {
                $result['pf'] = $right;
                $result['pd'] = $left;
            }
        } else {
            $result['pf'] = 0;
            $result['pd'] = 0;
        }


        return $result;
    }

    /**
     * Calcula el proximo rango del usuario
     * @return int|null
     */
    public function rank()
    {
        $pf = $this->totalPfAndPd()['pf'];
        $pd = $this->totalPfAndPd()['pd'];

        $rightNode = $this->underRightNode();
        $leftNode = $this->underLeftNode();

        if ($pf >= 3500000 && $pd >= 2400000) {//DIAMANTE CORONA
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 10) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 10) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 11;
                }
            }
        }
        if ($pf >= 1500000 && $pd >= 1000000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 9) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 9) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 10;
                }
            }
        }
        if ($pf >= 600000 && $pd >= 400000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 8) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 8) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 9;
                }
            }
        }
        if ($pf >= 240000 && $pd >= 16000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 7) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 7) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 8;
                }
            }
        }
        if ($pf >= 145000 && $pd >= 95000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 6) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 6) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 7;
                }
            }
        }
        if ($pf >= 95000 && $pd >= 65000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 5) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 5) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 6;
                }
            }
        }
        if ($pf >= 45000 && $pd >= 35000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 4) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 4) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 5;
                }
            }
        }
        if ($pf >= 24000 && $pd >= 16000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 3) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 3) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 4;
                }
            }
        }
        if ($pf >= 9000 && $pd >= 6000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 2) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 2) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 3;
                }
            }
        }
        if ($pf >= 3000 && $pd >= 1000) {
            $arrRankRight = [];
            $arrRankLeft = [];
            if ($rightNode && $leftNode) {
                foreach ($rightNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 1) {
                        $arrRankRight[] = $node;
                    }
                }

                foreach ($leftNode as $node) {
                    if ($node->user && $node->user->ranks_id >= 1) {
                        $arrRankLeft[] = $node;
                    }
                }
                if (count($arrRankLeft) && count($arrRankRight)) {
                    return 2;
                }
            }
        }
        return 1;
    }

    public function tree()
    {

        return $this->treeHtml($this->user->userMultilevel->hasChilds);
    }

    public function treeHtml($childs = [])
    {
        $html = '';
        foreach ($childs->sortByDesc('position') as $child) {


            if ($child->user->rank) {
                $img = asset($child->user->rank->image);
            } else {
                $img = asset("assets/images/rank/1.png");
            }
            switch ($child->position) {
                case('D'):
                    $positionLetter = "Ⓓ";
                    break;
                case('I'):
                    $positionLetter = "Ⓘ";
                    break;
            }
            if (count($child->hasChilds)) {
                $html .= '<li>
                            <a href="javascript:void(0);">
                                <div class="member-view-box">
                                    <div class="member-image">
                                        <img src="' . $img . '" alt="Member">
                                        <div class="member-details">
                                            <h4 style="text-transform: capitalize">' . $child->user->username . '</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            ' . $this->treeHtml($child->hasChilds) . '

                        </li>';
            } else {
                $html .= '
                        <li>
                            <a href="javascript:void(0);">
                                <div class="member-view-box">
                                    <div class="member-image">
                                        <img src="' . $img . '" alt="Member">
                                        <div class="member-details">
                                            <h4 style="text-transform: capitalize"> ' . $child->user->username . '</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        ';
            }
        }
        if ($html != '') {
            $html = '<ul class="active">' . $html . '</ul>';
            return $html;
        } else {
            return '';
        }
    }

    /**
     * Retorna todos los referidos por el usuario que tengan un posicion especifica dentro del multinivel
     * @param $position
     * @return \Illuminate\Support\Collection
     */
    public function referredsPosition($position)
    {
        $users = User::join('user_multilevels', 'user_multilevels.users_id', 'users.id')->where('users.sponsor_id', $this->user->id)->where('user_multilevels.position', $position)->get();
        return $users;
    }

    public function volumeNode($position, $dateStart = null, $dateEnd = null)
    {
        if (!$dateStart)
            $dateStart = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        if (!$dateEnd)
            $dateEnd = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $total = 0;
        $unders = $this->under();
        $arr = [];
        if (isset($unders[0][0])) {
            $arr[0] = UserMultilevel::where('users_id', $unders[0][0])->first();
        }
        if (isset($unders[0][1])) {
            $arr[1] = UserMultilevel::where('users_id', $unders[0][1])->first();
        }
        $unders = collect($arr);

        if (count($unders)) {
            $firstNodes = $unders->where('position', $position)->first();
            if ($firstNodes) {

                $total += $firstNodes->user->investment();

                $multilevel = new Multilevel($firstNodes->user);
                $underPlain = $multilevel->underPlain()->where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd);
                foreach ($underPlain as $node) {
                    $total += $node->user->investment();

                }
            }
        } else {
            return 0;
        }

        return $total;
    }
}
