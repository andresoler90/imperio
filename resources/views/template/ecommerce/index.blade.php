@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
        <div class="row">
                  <div class="col-md-12">
                     <div class="iq-card">
                        <div class="iq-card-body">
                           <div id="js-product-list">
                              <div class="Products">
                                 <ul class="product_list gridcount grid row">
                                    <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>Lorem ipsum dolor sit</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $100.00</b> <span class="offer-price ml-2">$150.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                             <a href="javascript:void();" class="new">New</a>
                                          </div>
                                          <div class="product-description">
                                             <h4>consectetur adipiscing elit</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $99.00</b> <span class="offer-price ml-2">$50.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>Sed dictum orci vel</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $199.00</b> <span class="offer-price ml-2">$15.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>neque venenatis</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $1000.00</b> <span class="offer-price ml-2">$500.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                             <a href="javascript:void();" class="new">New</a>
                                          </div>
                                          <div class="product-description">
                                             <h4>Proin at diam sit amet</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $150.00</b> <span class="offer-price ml-2">$50.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>augue rhoncus ornare</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $599.00</b> <span class="offer-price ml-2">$99.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>Nulla venenatis mi sed</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $199.00</b> <span class="offer-price ml-2">$50.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>Etiam interdum nisi et</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $100.00</b> <span class="offer-price ml-2">$150.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li><li class="product_item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                       <div class="product-miniature">
                                          <div class="thumbnail-container">
                                             <a href="#"><img src="https://dummyimage.com/384x250/000/fff" alt="product-image" class="img-fluid" /> </a>
                                          </div>
                                          <div class="product-description">
                                             <h4>dignissim orci quis</h4>
                                             <p class="mb-0">Proin sed risus mattis</p>
                                             <div class="ratting">
                                                <ul class="ratting-item d-flex p-0 m-0">
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="full"><i class="ri-star-fill"></i></li>
                                                   <li class="half"><i class="ri-star-half-line"></i></li>
                                                   <li class="blank"><i class="ri-star-line"></i></li>
                                                </ul>
                                             </div>
                                             <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-action">
                                                   <div class="add-to-cart"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Cart"> <i class="ri-shopping-cart-2-line"></i> </a></div>
                                                   <div class="wishlist"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist"> <i class="ri-heart-line"></i> </a></div>
                                                </div>
                                                <div class="product-price">
                                                   <div class="regular-price"><b> $100.00</b> <span class="offer-price ml-2">$150.00</span></div>
                                                </div>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
        </div>
    </div>
@endsection

@section('body_bottom')
@endsection
