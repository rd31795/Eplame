                <li class="nav-item pcoded-menu-caption">
                    <label>E-Shop</label>
                </li>
                {{--
                <li class="nav-item {{ \Request::route()->getName() === 'admin.banner.home.shortdescription'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.banner.home.shortdescription'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-image"></i></span><span class="pcoded-mtext">Description Banner</span></a>
                </li>
                --}}
                <li class="nav-item pcoded-hasmenu " >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Testimonial Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('list_testimonials',['type'=>App\Testimonial::E_SHOP]) }}" class="" title="You can manage the testimonials posted by the users.">Manage Testimonials</a></li>
                    </ul>
                </li>




              <li class="nav-item {{ \Request::route()->getName() === 'admin.products.category'
             ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{url(route('admin.products.category'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Product Categories</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu <?= ActiveMenu([
                        'admin.products.variation',
                        'admin.products.create.variations',
                        'admin.products.variations',
                        'admin.products.custom.fields.variations',
                        'admin.products.custom.fields.edit.variations',
                        'admin.products.variation.edit',
                        'admin.products.edit.variations'
                ],'pcoded-trigger') ?>" >
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                         <i class="feather icon-box"></i></span><span class="pcoded-mtext">Product Variations</span></a>

                       <ul class="pcoded-submenu" style="display: <?= ActiveMenu([
                        'admin.products.variation',
                        'admin.products.create.variations',
                        'admin.products.variations',
                        'admin.products.custom.fields.variations',
                        'admin.products.custom.fields.edit.variations',
                        'admin.products.variation.edit',
                        'admin.products.edit.variations',
                        'admin.products.list.brands'
                        ],'block') ?>;">

                         <li class="<?= ActiveMenu(['admin.products.list.brands'],'active') ?>">
                              <a href="{{ route('admin.products.list.brands') }}" class="">Brand</a>
                        </li>
                                 
                                 <li class="<?= ActiveMenu(['admin.products.create.variations'],'active') ?>">
                                      <a href="{{ route('admin.products.create.variations') }}" class="">Add New Variations</a>
                                </li>

                                <?php $variationMenus = App\Models\Products\Variation::where('status',1)->orderBy('name','ASC')->get(); ?>

                                @foreach($variationMenus as $v)
                                    <li class="<?php echo  Request::is('admin/product/variations/'.$v->type) ? 'active' : '' ?>">
                                      <a href="{{ route('admin.products.variations', $v->type) }}" class="">{{$v->name}}</a>
                                   </li>
                                @endforeach
                                
                      </ul>
                </li>
                {{--
                   <li class="nav-item {{ \Request::route()->getName() === 'admin.banner.home.setting'
                           ? 'nav-item active' : 'nav-item' }}">
                           <a href="{{url(route('admin.banner.home.setting'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Home Banner</span></a>
                   </li>
                       --}}

               <li class="nav-item {{ \Request::route()->getName() === 'admin.banner.home.slider'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.banner.home.slider'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Slider</span></a>
                </li>
        
              <li class="nav-item {{ \Request::route()->getName() === 'admin.products.list.types'
             ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{url(route('admin.products.list.types'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Product Types</span></a>
                </li>

               <li class="nav-item {{ \Request::route()->getName() === 'admin.shop.listing'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.shop.listing'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Shop Listing</span></a>
                </li>
                <li class="nav-item {{ \Request::route()->getName() === 'admin.shop.products.all.listing'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.shop.products.all.listing',5))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Product Listing</span></a>
                </li>

                <li class="nav-item {{ \Request::route()->getName() === 'admin.shop.cms'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.shop.cms'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">CMS Pages</span></a>
                </li>

                <li class="nav-item {{ \Request::route()->getName() === 'admin.home.product.listing'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.home.product.listing'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Home Product List</span></a>
                </li>

                <li class="nav-item {{ \Request::route()->getName() === 'admin.home.product.featured-package'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.home.product.featured-package'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Featured Packages</span></a>
                </li>


                <li class="nav-item {{ \Request::route()->getName() === 'admin.home.product.packages_purchase'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.home.product.packages_purchase'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Packages Order</span></a>
                </li>