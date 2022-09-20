<li class="nav-item pcoded-menu-caption">
                    <label>Event Management</label>
                </li>
                    @if(hasReadPermission('order-management', Auth::user()->id) || Auth::user()->role == 'admin')
                      <li class="nav-item {{ \Request::route()->getName() === 'admin.orders'
                                 ? 'nav-item active' : 'nav-item' }}">
                                        <a href="{{url(route('admin.orders'))}}" class="nav-link " title="You can find here a list of orders and their detials."><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Orders Management</span></a>
                     </li>
                     @endif
                     @if(hasReadPermission('escrow-management', Auth::user()->id) || Auth::user()->role == 'admin')
                     <li class="nav-item {{ \Request::route()->getName() === 'admin.escrow'
                                 ? 'nav-item active' : 'nav-item' }}">
                                        <a href="{{url(route('admin.escrow'))}}" class="nav-link" title="You can find here a list of escow amount and their detials."><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Escrow Management</span></a>
                     </li>
                     @endif
                     @if(hasReadPermission('menu-management', Auth::user()->id) || Auth::user()->role == 'admin')
                      <li class="nav-item {{ \Request::route()->getName() === 'admin.menu.list'
             ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{url(route('admin.menu.list'))}}" class="nav-link " title="This menu listing is used for sub-admin permissions of admin menu listing."><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Menus Listing</span></a>
                    </li>
                    @endif
                     @if(hasReadPermission('coupon-management', Auth::user()->id) || Auth::user()->role == 'admin')
                      <li class="nav-item {{ \Request::route()->getName() === 'admin.coupon.list'
             ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{url(route('admin.coupon.list'))}}" class="nav-link " title="You can create and manage coupen's for the users."><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Coupons Management</span></a>
                </li>
                    @endif 
                     @if(hasReadPermission('businesses-listing', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item {{ \Request::route()->getName() === 'admin.business.index'
             ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{url(route('admin.business.index'))}}" class="nav-link " title="You can manage the list of businesses listed on the website."><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Businesses Listing</span></a>
                </li>
                @endif
                    <!--  @if(hasReadPermission('dispute-management', Auth::user()->id) || Auth::user()->role == 'admin')
                 <li class="nav-item {{ \Request::route()->getName() === 'admin.vendor.dispute'
             ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{url(route('admin.vendor.dispute'))}}" class="nav-link " title="You can manage the disputes raised by the users on the events."><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Dispute Management</span></a>
                </li>
                @endif -->
                @if(hasReadPermission('disputes', Auth::user()->id) || hasReadPermission('dispute-reason', Auth::user()->id) || Auth::user()->role == 'admin')
                 <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.dispute-chat.index','admin.dispute-reason.index'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Disputes Management</span></a>
                       <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.dispute-chat.index','admin.dispute-reason.index'],'block') ?>;">
                         @if(hasReadPermission('disputes', Auth::user()->id) || Auth::user()->role == 'admin')
                          <li class="<?= ActiveMenu(['admin.dispute-chat.index','admin.dispute-reason.index'],'active') ?>">
                        <a href="{{route('admin.dispute-chat.index')}}" class="nav-link " title="You can manage the disputes raised by the users on the events.">Disputes</a> </li>
                          @endif
                         @if(hasReadPermission('dispute-reason', Auth::user()->id) || Auth::user()->role == 'admin')
                          <li class="<?= ActiveMenu(['admin.dispute-reason.index'],'active') ?>">
                        <a href="{{route('admin.dispute-reason.index')}}" class="nav-link " title="You can add the disputes reason.">Dispute Reasons</a> </li>
                           @endif
                   
                   </ul>
                </li>
                @endif
                @if(hasReadPermission('categories-management', Auth::user()->id) || hasReadPermission('default-task-list-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_category', 'category_variations', 'create_category','edit_category'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Category Management</span></a>
                        <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_category', 'category_variations', 'create_category','edit_category'],'block') ?>;">
                             @if(hasReadPermission('categories-management', Auth::user()->id) || Auth::user()->role == 'admin')
                            <li class="<?= ActiveMenu(['list_category', 'category_variations', 'create_category','edit_category'],'active') ?>"><a href="{{ route('list_category') }}" class="" title="You can manage the categories of the business listings.">Categories</a></li>
                            @endif
                            @if(hasReadPermission('default-task-list-management', Auth::user()->id) || Auth::user()->role == 'admin')

                             <li class="<?= ActiveMenu(['admin.category.taskList'],'active') ?>"><a href="{{ route('admin.category.taskList') }}" class="" title="You can manage the default tasks list for the user's event checklist.">Default Task List</a></li>
                             @endif
                        </ul>
                </li>
                @endif
                
                @if(hasReadPermission('event-type-management', Auth::user()->id) || hasReadPermission('group-management', Auth::user()->id) || Auth::user()->role == 'admin')     
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_events', 'create_event_type', 'edit_event'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Event/Celebration Types</span></a>
                <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_events', 'create_event_type', 'edit_event', 'list_groups', 'create_group', 'edit_group'],'block') ?>;">
                    @if(hasReadPermission('event-type-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_events', 'create_event_type', 'edit_event'],'active') ?>"><a href="{{ route('list_events') }}" class="" title="You can manage the event types like wedding, burthday party etc. These types will be shown to the users for choosing event type in create event form.">Event Types</a></li>
                    @endif
                    @if(hasReadPermission('group-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_groups', 'create_group', 'edit_group'],'active') ?>"><a href="{{ route('list_groups') }}" class="" title="You can manage the event types like wedding, burthday party etc. These types will be shown to the users for choosing event type in create event form.">Group Management</a></li>
                    @endif
                </ul>
                </li>
                @endif

                @if(hasReadPermission('amenities-management', Auth::user()->id) || hasReadPermission('games-management', Auth::user()->id) || Auth::user()->role == 'admin') 
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_amenities', 'list_games', 'create_amenities_type', 'edit_amenity'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Amenities/Games Types</span></a>
                <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_amenities', 'list_games', 'create_amenities_type', 'edit_amenity'],'block') ?>;">
                    @if(hasReadPermission('amenities-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_amenities'],'active') ?>"><a href="{{ route('list_amenities') }}" class="" title="You can create and manage the amenities for events.">Amenities</a></li>
                    @endif
                    @if(hasReadPermission('games-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_games'],'active') ?>"><a href="{{ route('list_games') }}" class="" title="You can create and manage the games for events.">Games</a></li>
                    @endif
                </ul>
                </li>
                @endif

                <!-- @if(hasReadPermission('seasons-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_seasons', 'create_seasons', 'edit_seasons'],'pcoded-trigger') ?>" >
                           <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                                <i class="feather icon-box"></i></span><span class="pcoded-mtext"> Manage Seasons</span></a>
                            <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_seasons', 'create_seasons', 'edit_seasons', 'create_seasons', 'edit_seasons'],'block') ?>;">
                                <li class="<?= ActiveMenu(['list_seasons', 'create_seasons', 'edit_seasons'],'active') ?>"><a href="{{ route('list_seasons') }}" class="">Seasons</a></li>
                            </ul>
                    </li>
                @endif -->

                @if(hasReadPermission('user-management', Auth::user()->id) || hasReadPermission('vendor-management', Auth::user()->id) || hasReadPermission('sub-admin-management', Auth::user()->id) || hasReadPermission('new-vendors-management', Auth::user()->id) || hasReadPermission('vendor-invite-list', Auth::user()->id) || hasReadPermission('user-invite-list', Auth::user()->id) ||
                Auth::user()->role == 'admin') 
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_users', 'list_vendors', 'admin_vendor_business','admin.vendor.list','admin.vendor.invite','admin.subadmin.list','admin.group.list'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link"><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">User/Vendor Management</span></a>
                <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_users', 'list_vendors', 'admin_vendor_business','admin.vendor.list','admin.vendor.invite'], 'block') ?>;">
                    @if(hasReadPermission('user-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="<?= ActiveMenu(['list_users'],'active') ?>">
                        <a href="{{ route('list_users') }}" class="" title="You can see the list of users of the website.">User Management</a>
                    </li>
                    @endif
                    @if(hasReadPermission('vendor-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="<?= ActiveMenu(['list_vendors', 'admin_vendor_business'],'active') ?>">
                        <a href="{{ route('list_vendors') }}" class="" title="You can see the list of users of the website.">Vendor Management</a>
                    </li>
                    @endif
                    @if(hasReadPermission('sub-admin-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="<?= ActiveMenu(['admin.subadmin.list'],'active') ?>">
                        <a href="{{ route('admin.subadmin.list') }}" class="" title="You can manage the sub-admin and their permissions.">Subadmin Management</a>
                    </li>
                    @endif
                    @if(hasReadPermission('subadmin-group-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="<?= ActiveMenu(['admin.group.list'],'active') ?>">
                        <a href="{{ route('admin.group.list') }}" class="" title="You can manage the groups for subadmin and their permissions.">Group Management</a>
                    </li>
                    @endif
                    @if(hasReadPermission('new-vendors-management', Auth::user()->id) || Auth::user()->role == 'admin')
                      <li class="<?= ActiveMenu(['admin.vendor.list'],'active') ?>">
                        <a href="{{ route('admin.vendor.list') }}" class="" title="You can view the list of latest vendors.">New Vendors</a>
                    </li>
                    @endif
                    @if(hasReadPermission('vendor-invite-list', Auth::user()->id) || Auth::user()->role == 'admin' || Auth::user()->role == 'admin')
                     <li class="<?= ActiveMenu(['admin.vendor.invite'],'active') ?>">
                        <a href="{{ route('admin.vendor.invite') }}" class="" title="You can view the list of latest vendor invitations.">Inviting Vendor List</a>
                    </li>
                    @endif
                    @if(hasReadPermission('user-invite-list', Auth::user()->id) || Auth::user()->role == 'admin')
                     <li class="<?= ActiveMenu(['admin.user.invite'],'active') ?>">
                        <a href="{{ route('admin.user.invite') }}" class="" title="You can view the list of latest user invitations.">Inviting User List</a>
                    </li>
                    @endif
                </ul>
                </li>
                @endif
                @if(hasReadPermission('venues-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li  class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.venues.list', 'admin.venues.showCreate', 'admin.venues.showEdit'],'pcoded-trigger') ?>" >
                     <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                           <i class="feather icon-box"></i></span><span class="pcoded-mtext">Venues Management</span>
                     </a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.venues.list', 'admin.venues.showCreate', 'admin.venues.showEdit'], 'block') ?>;">
                        <li class="<?= ActiveMenu(['admin.venues.list', 'admin.venues.showCreate', 'admin.venues.showEdit'],'active') ?>"><a href="{{ route('admin.venues.list') }}" class="" title="You can manage the event venues.">Venues Management</a></li>
                    </ul>
                </li>
                @endif
                @if(hasReadPermission('styles-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.styles.list', 'admin.styles.showCreate', 'admin.styles.showEdit'],'pcoded-trigger') ?>" >
                        <a href="javascript:" class="nav-link " ><span class="pcoded-micon">
                            <i class="feather icon-box"></i></span><span class="pcoded-mtext">Styles Management</span></a>
                        <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.styles.list', 'admin.styles.showCreate', 'admin.styles.showEdit'], 'block') ?>;">
                            <li class="<?= ActiveMenu(['admin.styles.list', 'admin.styles.showCreate', 'admin.styles.showEdit'],'active') ?>"><a href="{{ route('admin.styles.list') }}" class="" title="You can manage the Event themes.">Styles Management</a></li>
                        </ul>
                    </li>
                @endif
                @if(hasReadPermission('page-management', Auth::user()->id) || hasReadPermission('payment-management', Auth::user()->id) || hasReadPermission('global-management', Auth::user()->id) || hasReadPermission('commission-management', Auth::user()->id) || 
                Auth::user()->role == 'admin')
             <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_general_settings', 'add_general_settings', 'list_payment_settings', 'global_settings'],'pcoded-trigger') ?>" >
                <a href="javascript:" class="nav-link " ><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Settings</span></a>
                <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_general_settings', 'add_general_settings', 'list_payment_settings', 'global_settings'], 'block') ?>;">
                    @if(hasReadPermission('page-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_general_settings', 'add_general_settings'],'active') ?>"><a href="{{ route('list_general_settings') }}" class="" title="You can manage the Page settings.">Page Settings</a></li>
                    @endif
                    @if(hasReadPermission('payment-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['list_payment_settings'],'active') ?>"><a href="{{ route('list_payment_settings') }}" class="" title="You can manage the Payment settings.">Payment Settings</a></li>
                    @endif
                    @if(hasReadPermission('global-management', Auth::user()->id) || Auth::user()->role == 'admin')
                        <li class="<?= ActiveMenu(['global_settings'],'active') ?>">
                        <a href="{{ route('global_settings') }}" class="" title="You can manage the Global settings.">Global Settings</a>
                    </li>
                    @endif
                    @if(hasReadPermission('commission-management', Auth::user()->id) || Auth::user()->role == 'admin')    
                        <li class="<?= ActiveMenu(['admin.commission'],'active') ?>">
                        <a href="{{ route('admin.commission') }}" class="" title="You can manage the vendor commission settings.">Commisson Settings</a>
                        </li>
                    @endif
                </ul>
                </li>
                @endif
                @if(hasReadPermission('business-email-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.emails.index'],'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                        <i class="feather icon-box"></i></span><span class="pcoded-mtext">Email Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.emails.index'], 'block') ?>;">
                        <li class="<?= ActiveMenu(['admin.emails.index'],'active') ?>"><a href="{{ route('admin.emails.index') }}" class="" title="You can manage the Bussiness emails.">Business Emails</a></li>
                    </ul>
                </li>
                @endif

                @if(hasReadPermission('fee-management', Auth::user()->id) || hasReadPermission('vendor-commission-fee', Auth::user()->id) || Auth::user()->role == 'admin')
                   <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.commission','admin.commissionSlabs'],'pcoded-trigger') ?>" >
                        <a href="javascript:" class="nav-link " ><span class="pcoded-micon">
                            <i class="feather icon-box"></i></span><span class="pcoded-mtext">Commission Fee</span></a>
                        <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.commission','admin.commissionSlabs','admin.commission.list'], 'block') ?>;">
                           
                            <li class="<?= ActiveMenu(['admin.commission'],'active') ?>">
                                <a href="{{ route('admin.commission') }}" class="" title="You can manage the Global commission fee.">Fee</a>
                            </li>
                             <li class="<?= ActiveMenu(['admin.commission.list'],'active') ?>">
                                <a href="{{ route('admin.commission.list') }}" class="" title="You can manage the perticular Vendor's commission fee.">Vendor Commission Fee</a>
                            </li>
                        </ul>
                   </li>
                @endif
                <!-- Faqs Management -->
                @if(hasReadPermission('faq-management', Auth::user()->id) ||  
                Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.faqs.lists', 'admin.faqs.showCreate', 'admin.faqs.edit'], 'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Faqs Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.faqs.lists', 'admin.faqs.showCreate', 'admin.faqs.edit'], 'block') ?>;">
                        
                            <li class="{{ ((\Request::route()->getName() === 'admin.faqs.lists' || \Request::route()->getName() === 'admin.faqs.showCreate' || \Request::route()->getName() === 'admin.faqs.edit') && Request::route('type') === 'user' ) ? 'active' : '' }}"><a href="{{ route('admin.faqs.lists', ['type' => 'user']) }}" class="" title="You can manage the User's Faq's.">User Faqs</a></li>
                        
                            <li class="{{ ((\Request::route()->getName() === 'admin.faqs.lists' || \Request::route()->getName() === 'admin.faqs.showCreate' || \Request::route()->getName() === 'admin.faqs.edit') && Request::route('type') === 'vendor' ) ? 'active' : '' }}"><a href="{{ route('admin.faqs.lists', ['type' => 'vendor']) }}" class="" title="You can manage the Vendor's Faq's.">Vendor Faqs</a></li>
                    </ul>
                </li>
                @endif
                @if(hasReadPermission('news-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['admin.newsoffers.lists', 'admin.newsoffers.showCreate', 'admin.newsoffers.edit'], 'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">News Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['admin.newsoffers.lists', 'admin.newsoffers.showCreate', 'admin.newsoffers.edit'], 'block') ?>;">
                        <li class="{{ ((\Request::route()->getName() === 'admin.newsoffers.lists' || \Request::route()->getName() === 'admin.newsoffers.showCreate' || \Request::route()->getName() === 'admin.newsoffers.edit') && Request::route('type') === 'news' ) ? 'active' : '' }}"><a href="{{ route('admin.newsoffers.lists', ['type' => 'news']) }}" class="" title="You can manage the news which will be shown on the home page.">News</a></li>
                    </ul>
                </li>
                @endif
                <!-- Faqs Management -->
                @if(hasReadPermission('forum-groups-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_forum_groups', 'create_forum_group', 'edit_forum_group'], 'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Forum Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_forum_groups', 'create_forum_group', 'edit_forum_group'], 'block') ?>;">
                        <li class="{{ (\Request::route()->getName() === 'list_forum_groups' || \Request::route()->getName() === 'create_forum_group' || \Request::route()->getName() === 'edit_forum_group') ? 'active' : '' }}"><a href="{{ route('list_forum_groups') }}" class="" title="You can manage the news which will be shown on the home page.">Manage Groups</a></li>
                    </ul>
                </li>
                @endif

                @if(hasReadPermission('cms-pages-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="nav-item <?= ActiveMenu(['admin.cms-pages.list', 'admin.cms-pages.showCreate', 'admin.cms-pages.edit'],'active') ?>">
                        <a href="{{url(route('admin.cms-pages.list'))}}" title="You can manage the CMS pages like about-us,privacy-policy etc." class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Cms Pages</span></a>
                    </li>
                @endif
                @if(hasReadPermission('cms-menu-management', Auth::user()->id) || Auth::user()->role == 'admin')
                    <li class="nav-item <?= ActiveMenu(['admin.cms-menu.list', 'admin.cms-menu.showCreate', 'admin.cms-menu.edit'],'active') ?>">
                        <a href="{{url(route('admin.cms-menu.list'))}}" title="You can manage the CMS pages like about-us,privacy-policy etc." class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Cms Menu</span></a>
                    </li>
                @endif
                @if(hasReadPermission('testimonial-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_testimonials', 'create_testimonial', 'edit_testimonial'], 'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Testimonial Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_testimonials', 'create_testimonial', 'edit_testimonial'], 'block') ?>;">
                        <li class="{{ (\Request::route()->getName() === 'create_testimonial' || \Request::route()->getName() === 'edit_testimonial' || \Request::route()->getName() === 'list_testimonials') ? 'active' : '' }}"><a href="{{ route('list_testimonials',['type'=>App\Testimonial::EVENTS] ) }}" class="" title="You can manage the testimonials posted by the users.">Manage Testimonials</a></li>
                    </ul>
                </li>
                @endif
                @if(hasReadPermission('review-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_reviews', 'create_review', 'edit_review'], 'pcoded-trigger') ?>" >
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                    <i class="feather icon-box"></i></span><span class="pcoded-mtext">Review Management</span></a>
                    <ul class="pcoded-submenu" style="display: <?= ActiveMenu(['list_reviews', 'edit_review'], 'block') ?>;">
                        <li class="{{ (\Request::route()->getName() === 'edit_review' || \Request::route()->getName() === 'list_reviews') ? 'active' : '' }}"><a href="{{ route('list_reviews') }}" class="" title="You can manage the reviews submitted by the users.">Manage Reviews</a></li>
                    </ul>
                </li>
                @endif
                @if(hasReadPermission('thank-you-templates-management', Auth::user()->id) || Auth::user()->role == 'admin')
                <li class="nav-item <?= ActiveMenu(['admin.thank-you-template.list', 'admin.thank-you-template.showCreate', 'admin.thank-you-template.edit'],'active') ?>">
                    <a href="{{url(route('admin.thank-you-template.list'))}}" class="nav-link " title="You can manage the thankyou templates used to send the thankyou notes"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Thank You Templates</span></a>
                </li>
                @endif
                @if(Auth::user()->role == 'admin')
                <li class="nav-item {{ \Request::route()->getName() === 'admin.home.event.listing.featured-package'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.home.event.featured-package'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Featured Packages</span></a>
                </li>
                @endif

                @if(Auth::user()->role == 'admin')
                <li class="nav-item {{ \Request::route()->getName() === 'admin.home.event.packages_purchase'
                ? 'nav-item active' : 'nav-item' }}">
                <a href="{{url(route('admin.home.event.packages_purchase'))}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-briefcase"></i></span><span class="pcoded-mtext">Packages Order</span></a>
                </li>
                @endif
                <!-- <li class="nav-item pcoded-hasmenu <?= ActiveMenu(['list_ticket', 'create_ticket', 'edit_ticket'], 'pcoded-trigger') ?>" >
                                                  <a href="javascript:" class="nav-link "><span class="pcoded-micon">
                                                  <i class="feather icon-box"></i></span><span class="pcoded-mtext">Ticket Management</span></a>
                                                  <ul class="pcoded-submenu" style="">
                                                      <li class="{{ (\Request::route()->getName() === 'create_ticket_type' || \Request::route()->getName() === 'edit_ticket_type' || \Request::route()->getName() === 'list_ticket_type') ? 'active' : '' }}"><a href="{{ route('list_ticket_type') }}" class="" title="You can manage the events tickets here.">Ticket Type</a></li>
                                                  </ul>
                                              </li> - -->

