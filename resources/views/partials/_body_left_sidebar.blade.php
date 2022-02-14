<!-- Sidebar  -->
<div class="iq-sidebar fondo-menu">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ route('dashboard') }}">
            {{--            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="">--}}
            <img src={{asset("assets/images/logo-white-strongbox.png")}} class="img-fluid" alt="logo"
                 style=" max-height: 100px;   height: auto; padding: 17px 10px;">
        </a>
    </div>

    @php
        $MyNavBar = \Menu::make('MenuList', function ($menu) {

            if (Auth::user()->role->id == 1){
            $menu->raw(__('Administrador'), ['class' => 'iq-menu-title'])->prepend('<i class="ri-separator"></i>');
        }
      else {
           $menu->raw(__('Usuario'), ['class' => 'iq-menu-title'])->prepend('<i class="ri-separator"></i>');
      }

           // $menu->raw(__('Menu Usuario'), ['class' => 'iq-menu-title'])->prepend('<i class="ri-separator"></i>');

            $menu->add('<span>'.__('Inicio').'</span>', ['route' => 'dashboard'] )
                    ->active('dashboard/*')
                    ->prepend('<i class="ri-home-4-line"></i>')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

        //    $menu->add('<span>'.__('Noticias').'</span>', ['route' => 'news.index'] )
        //      ->prepend('<i class="fa fa-leanpub"></i>')
        //        ->active('red/*')
        //       ->link->attr(["class" => "nav-link iq-waves-effect"]);

            if (Auth::user()->role->id == 1){


                $menu->add('<span>'.__('Usuarios').'</span>', ['route' => 'user.index'])
                ->active('crud/user/*')
                ->prepend('<i class="fa fa-users"></i>')
                ->link->attr(['class' => '']);

                $menu->add('<span>'.__('Aprobar Solicitudes').'</span>', ['class' => ''])
                ->prepend('<i class="ri-user-settings-line"></i>')
                ->nickname('admin')->link->attr(["class" => "nav-link iq-waves-effect"])
                ->href('#email');
            //$menu->admin
            //    ->add('<span>'.__('Gestión de tickets').'</span>', ['class' => ''])
            //    ->nickname('tickets')
            //    ->link->attr(["class" => "nav-link iq-waves-effect"])
            //    ->href('#tickets');
            //$menu->tickets
            //    ->add('<span>'.__('Categorias').'</span>', ['route' => ['category.index']] )
            //    ->active('crud/tickets/categories/*')
            //    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            //$menu->tickets
            //    ->add('<span>'.__('Prioridad').'</span>', ['route' => 'priority.index'] )
            //    ->active('crud/tickets/priority/*')
            //    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            //$menu->tickets
            //    ->add('<span>'.__('Estados').'</span>', ['route' => 'status.index'] )
            //    ->active('crud/tickets/status/*')
            //    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            //$menu->tickets
            //    ->add('<span>'.__('Listado de tickets').'</span>', ['route' => 'user.ticket'] )
            //    ->active('tickets/*')
            //    ->link->attr(["class" => "nav-link iq-waves-effect"]);
           /* $menu->admin
                ->add('<span>'.__('Usuarios').'</span>', ['route' => 'user.index'])
                ->active('crud/user/*')
                ->link->attr(['class' => '']);*/

            $menu->admin
                ->add('<span>'.__('Membresias').'</span>', ['route' => 'membership.index'])
                ->active('crud/membership/*')
                ->link->attr(['class' => '']);

                $menu->admin
                    ->add('<span>'.__('Suscripciones').'</span>', ['route' => 'subscription.index'])
                    ->active('crud/subscription/*')
                    ->link->attr(['class' => '']);

            $menu->admin
                ->add('<span>'.__('Pool').'</span>', ['route' => 'list.pool.upgrades'])
                ->active('crud/poolUpgrade/*')
                ->link->attr(['class' => '']);

            $menu->admin
                ->add('<span>'.__('KYC').'</span>', ['route' => 'kyc.index'])
                ->active('crud/kyc/*')
                ->link->attr(['class' => '']);
            //$menu->admin
            //    ->add('<span>'.__('Calendario').'</span>', ['route' => 'crud.calendar.index'])
            //    ->active('crud/calendar/*')
            //    ->link->attr(['class' => '']);
            $menu->admin
                ->add('<span>'.__('Productos').'</span>', ['route' => 'membership.list'])
                ->active('crud/membership/list')
                ->link->attr(['class' => '']);

            $menu->admin
                ->add('<span>'.__('Pagos').'</span>', ['route' => 'payment.index'])
                ->active('crud/payment/*')
                ->link->attr(['class' => '']);

             $menu->admin
                ->add('<span>'.__('ROI').'</span>', ['route' => 'roiPayment.index'])
                ->active('crud/roi/*')
                ->link->attr(['class' => '']);

            $menu->admin
                ->add('<span>'.__('Pagos ROI').'</span>', ['route' => 'roi.index'])
                ->active('roi/*')
                ->link->attr(['class' => '']);

               $menu->add('<span>'.__('Configuraciones').'</span>', ['class' => ''])
                ->prepend('<i class="ri-settings-5-fill"></i>')
                ->nickname('configuraciones')
                ->link->attr(["class" => "nav-link iq-waves-effect"])
                ->href('#configuraciones');
                  $menu->configuraciones
                ->add('<span>'.__('Roles').'</span>', ['route' => 'roles.index'])
                ->active('crud/roles/*')
                ->link->attr(['class' => '']);
                $menu->configuraciones
                ->add('<span>'.__('Rangos').'</span>', ['route' => 'rankAdmin.index'])
                ->active('crud/ramks/*')
                ->link->attr(['class' => '']);
               $menu->configuraciones
                ->add('<span>'.__('Traducciones').'</span>', ['route' => ['languages.translations.index','es']])
                ->link->attr(['class' => '']);

               $menu->add('<span>'.__('Seguridad').'</span>', ['class' => ''])
                ->prepend('<i class="fa fa-id-card-o"></i>')
                ->nickname('seguridad')
                ->link->attr(["class" => "nav-link iq-waves-effect"])
                ->href('#seguridad');
            $menu->seguridad
                ->add('<span>'.__('Log').'</span>', 'admin/user-activity')
                ->active('crud/log/*')
                ->link->attr(['class' => '']);

            $menu
                ->add('<span>'.__('Negocio').'</span>', ['class' => ''])
                ->nickname('reports')
                ->prepend('<i class="fa fa-bar-chart"></i>')
                ->link->attr(['class' => 'nav-link iq-waves-effect'])
                ->href('#reports');
            $menu->reports
                ->add('<span>'.__('Referidos').'</span>', ['route' => ['report.referred.index']])
                ->link->attr(['class' => '']);

            }
            if(Auth::user()->userMultilevel){
                $menu->add('<span>'.__('Red').'</span>', ['route' => 'user.multilevel'] )
                        ->prepend('<i class="fa fa-users"></i>')
                        ->active('red/*')
                        ->link->attr(["class" => "nav-link iq-waves-effect"]);
            }

            if (Auth::user()->role->id != 1){
            $menu->add('<span>'.__('Rangos').'</span>', ['route' => 'user.ranks.list'] )
                    ->prepend('<i class="fa fa-sitemap"></i>')
                    ->active('red/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            $menu->add('<span>'.__('Registro de usuario').'</span>', ['route' => 'user.add.reference'] )
                    ->prepend('<i class="ri-user-add-line"></i>')
                    ->active('multinivel/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            $menu->add('<span>'.__('Balances').'</span>', ['class' => ''])
                    ->prepend('<i class="fa fa-bar-chart"></i>')
                    ->nickname('balance')
                    ->link->attr(['class' => 'nav-link iq-waves-effect'])
                    ->href('#balance');
            $menu->balance
                    ->add('<span>'.__('Transacciones').'</span>', ['route' => 'user.wallet'] )
                    ->active('wallet/*')
                    ->prepend('<i class="ri-wallet-3-line"></i>')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

            $menu->balance
                    ->add('<span>'.__('ROI').'</span>', ['route' => 'user.roi'] )
                    ->active('wallet/*')
                    ->prepend('<i class="ri-wallet-3-line"></i>')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

            $menu->add('<span>'.__('Pagos').'</span>', ['route' => 'user.payment'] )
                    ->prepend('<i class="fa fa-money"></i>')
                    ->active('payments/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

            $menu->add('<span>'.__('ROI').'</span>', ['route' => 'user.paymentRoi'] )
                    ->prepend('<i class="fa fa-money"></i>')
                    ->active('payments/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);        

            $menu->add('<span>'.__('Bonos').'</span>', ['route' => 'user.bonus.retained'] )
                    ->prepend('<i class="fa fa-pie-chart"></i>')
                    ->active('bonus/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

            $menu
                    ->add('<span>'.__('Negocio').'</span>', ['class' => ''])
                    ->prepend('<i class="fa fa-bar-chart"></i>')
                    ->nickname('reports')
                    ->link->attr(['class' => 'nav-link iq-waves-effect'])
                    ->href('#reports');
                $menu->reports
                    ->add('<span>'.__('Referidos').'</span>', ['route' => ['report.referred.index']])
                    ->link->attr(['class' => '']);

                   $menu->add('<span>'.__('Mis Compras').'</span>', ['route' => 'user.shoppinghistory.index'] )
                    ->prepend('<i class="ri-refund-fill"></i>')
                    ->active('multinivel/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);

                    $menu->add('<span>'.__('Productos').'</span>', ['class' => ''])
                    ->prepend('<i class="ri-shopping-bag-3-fill"></i>')
                    ->nickname('products')
                    ->link
                    ->attr(["class" => "nav-link iq-waves-effect"])
                    ->href('#products');
                $menu->products->add('<span>'.__('Pool inversiones').'</span>', ['route' => ['user.pricing','pool']])
                    ->active('crud/pricing/*')
                    ->link->attr(['class' => '']);
                 if(!count(Auth::user()->hasSuscription)){
                $menu->products->add('<span>'.__('Suscripciones').'</span>', ['route' => ['user.pricing','subscription']])
                   ->active('crud/pricing/subscription')
                  ->link->attr(['class' => '']);
                   }
                $menu->products->add('<span>'.__('Academia').'</span>', ['route' => ['user.pricing','academys']])
                    ->active('crud/pricing/academys')
                    ->link->attr(['class' => '']);
            }

        if (Auth::user()->role->id == 1){
              $menu->add('<span>'.__('Reportes').'</span>', ['class' => ''])
                ->prepend('<i class="fa fa-id-card-o"></i>')
                ->nickname('reportes')
                ->link->attr(["class" => "nav-link iq-waves-effect"])
                ->href('#reportes');
           $menu->reportes
                ->add('<span>'.__('Top Ventas').'</span>', ['route' => 'SponserTop.index'])
                ->active('crud/SponserTop/*')
                ->link->attr(['class' => '']);
             $menu->reportes
                ->add('<span>'.__('Pagos Coinbase').'</span>', ['route' => 'ReporteCoinbase.index'])
                ->active('crud/ReporteCoinbase/*')
                ->link->attr(['class' => '']);
             $menu->reportes
                ->add('<span>'.__('Historial Compras').'</span>', ['route' => 'shoppinghistory.index'])
                ->active('crud/reports/shopping/*')
                ->link->attr(['class' => '']);
              $menu->reportes
                ->add('<span>'.__('Comisiones').'</span>', ['route' => 'report.balance.index'])
                ->active('crud/reports/commissions/*')
                ->link->attr(['class' => '']);
            }

            if (Auth::user()->roles_id != 1) {
            //    $menu->add('<span>'.__('Tickets').'</span>', ['route' => 'user.ticket'] )
            //           ->prepend('<i class="fa fa-ticket"></i>')
            //           ->active('tickets/*')
            //           ->link->attr(["class" => "nav-link iq-waves-effect"]);
            }

            $menu->add('<span>'.__('Gestión de perfil').'</span>', ['class' => ''])
                ->prepend('<i class="fa fa-id-card-o"></i>')
                ->nickname('profile')
                ->link->attr(["class" => "nav-link iq-waves-effect"])
                ->href('#perfil');

            $menu->profile
                    ->add('<span>'.__('Vista del perfil').'</span>', ['route' => ['profile.edit', 'user']] )
                    ->active('profiles/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            $menu->profile
                    ->add('<span>'.__('Detalle de KYC').'</span>', ['route' => 'user.kyc'] )
                    ->active('kyc/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect"]);
            $menu->add('<span>'.__('Cerrar sesión').'</span>', ['route' => 'logout'] )
                    ->prepend('<i class="ri-login-box-line"></i>')
                    ->active('logout/*')
                    ->link->attr(["class" => "nav-link iq-waves-effect",'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit()"]);
        })->filter(function ($item) {
            return $item;
        });
    @endphp

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                @include(config('laravel-menu.views.bootstrap-items'), ['items' => $MyNavBar->roots()])
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
