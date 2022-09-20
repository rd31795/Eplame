<?php

Route::get('/admin/login', 'Admin\AdminController@index')->name('admin_login');
Route::post('/admin/login', 'Admin\AdminController@check')->name('post_admin_login');

// Products
Route::post('/admin/featured-package-purchase/product/{id}','Admin\FeaturedPackagesControllers@BuyPackage')->name('featured_package_purchase');
Route::get('/admin/featured-package-status/product/{id}','Admin\FeaturedPackagesControllers@changePlanStatus')->name('activate_new_plan');

// Events
Route::post('/admin/featured-package-purchase/{id}','Admin\FeaturedPackagesControllers@BuyPackageEvent')->name('featured_package_purchase_event');
Route::get('/admin/featured-package-status/{id}','Admin\FeaturedPackagesControllers@changePlanStatusEvent')->name('activate_new_plan_event');

Route::group(['middleware' => ['AdminAuth'], 'prefix' => 'admin'], function() {
       require __DIR__.'/ajax.php';
       require __DIR__.'/product.php';
       require __DIR__.'/banner.php';
       require __DIR__.'/homeproductlist.php';
       
		Route::get('/','Admin\AdminController@dashboard')->name('admin_dashboard');
		Route::get('/maintenance-management','Admin\AdminController@maintenance')->name('manage_maintenance');
		Route::get('/maintenance-page','Admin\AdminController@maintenanceSetting')->name('maintenance_setting');
		Route::post('/maintenance-page','Admin\AdminController@updateMaintenance')->name('admin.maintenance_settings');
		Route::get('/profile/settings','Admin\AdminController@profile')->name('admin_settings');
		Route::post('/profile/settings/image','Admin\AdminController@changeProfileImage')->name('post_admin_settings');
		Route::post('/profile/settings/password','Admin\AdminController@change')->name('post_admin_password_settings');

		Route::get('/logout', 'Admin\AdminController@logout')->name('admin_logout');


		#-----------------------------------------------------------------------------------
#  Event Featured Packages Start
#-----------------------------------------------------------------------------------
Route::get('featured-packages','Admin\FeaturedPackagesControllers@eventIndex')->name('admin.home.event.featured-package');
Route::get('featured-packages/add','Admin\FeaturedPackagesControllers@addEvent')->name('admin.home.event.featured-package.add');
Route::post('featured-package/store','Admin\FeaturedPackagesControllers@store')->name('admin.home.event.featured-package.store');
Route::get('featured-package/packages','Admin\FeaturedPackagesControllers@getPackagesEvent')->name('ajax_getpackages_event');
Route::get('featured_event_status/{id}','Admin\FeaturedPackagesControllers@toggleStatusEvent')->name('featured_event_status');
Route::get('featured_event_edit/{id}','Admin\FeaturedPackagesControllers@editEvent')->name('featured_event_edit');
Route::post('featured_event_edit/{id}','Admin\FeaturedPackagesControllers@update')->name('admin.home.event.featured-package.update');
Route::get('featured-event-package-order','Admin\FeaturedPackagesControllers@packagesOrderEvent')->name('admin.home.event.packages_purchase');
Route::get('featured-package-order-content-event','Admin\FeaturedPackagesControllers@OrderContentEvent')->name('ajax_getpackages_order_event');
#-----------------------------------------------------------------------------------
#  Event Featured Packages End
#-----------------------------------------------------------------------------------
      
        #----------------------------------------------------------------
		#  Ticket Management
		#----------------------------------------------------------------
		#************************************************Ticket Types**************************************#
           Route::get('ticket/type/index','Admin\TicketController@index')->name('list_ticket_type');
           Route::get('ticket/type/create','Admin\TicketController@create')->name('create_ticket_type');
           Route::get('ticket/type/edit','Admin\TicketController@edit')->name('edit_ticket_type');
           Route::get('ticket/type/get_data_ajax','Admin\TicketController@ticketTypeAjax')->name('admin.ticket_type_ajax');
           Route::get('ticket/type/delete','Admin\TicketController@delete')->name('delete_ticket_type');
           Route::get('ticket/type/status','Admin\TicketController@status')->name('status_ticket_type');
           Route::post('ticket/type/store','Admin\TicketController@store')->name('store_ticket_type');


		#----------------------------------------------------------------
		#  Category Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:categories-management,read_permission']], function() {
			Route::get('/category/index','Admin\CategoryController@index')->name('list_category');
		});

		Route::group(['middleware' => ['SubAdminAuth:categories-management,write_permission']], function() {
			Route::get('/category/index/sorting','Admin\CategoryController@sortingIndex')->name('index_sorting_category');
			Route::post('ajax/category/index/sorting','Admin\CategoryController@sorting')->name('sorting_category');
			Route::get('/category/create','Admin\CategoryController@create')->name('create_category');
			Route::post('/category/create','Admin\CategoryController@store')->name('store_category');
			Route::get('/category/edit/{slug}','Admin\CategoryController@edit')->name('edit_category');
			Route::get('/category/variations/{slug}','Admin\CategoryController@category_variations')->name('category_variations');

			Route::post('/category/variations/{slug}','Admin\CategoryController@category_variations_save')->name('category_variations_save');

			Route::post('/category/edit/{slug}','Admin\CategoryController@update')->name('update_category');
			Route::get('/category/delete/{id}','Admin\CategoryController@delete')->name('delete_category');
			Route::post('/category/delete/image/{id}','Admin\CategoryController@deleteImage')->name('delete_category_image');
			Route::get('/category/ajax/edit/','Admin\CategoryController@edit2')->name('edit_ajax_category');
		});

		Route::group(['middleware' => ['SubAdminAuth:default-task-list-management,read_permission']], function() {
			Route::get('/category/tasks/index','Admin\CategoryController@taskList')->name('admin.category.taskList');
			Route::get('/ajax/category/tasks','Admin\CategoryController@getTaskCategory')->name('admin.category.getTaskCategory');
	        Route::get('/ajax/category/tasks/ajax','Admin\CategoryController@ajax2')->name('admin.category.ajax2');
			
	    });
	    Route::group(['middleware' => ['SubAdminAuth:default-task-list-management,write_permission']], function() {
	    	Route::get('/category/tasks/add','Admin\CategoryController@tasks')->name('admin.category.tasks.add');
			Route::post('/category/tasks/add','Admin\CategoryController@postTasks')->name('admin.category.tasks.add');

	        Route::get('/category/tasks/edit/{id}','Admin\CategoryController@editTask')->name('admin.category.tasks.edit');
	        Route::post('/category/tasks/edit/{id}','Admin\CategoryController@updateTask')->name('admin.category.tasks.edit');
	    });


		#----------------------------------------------------------------
		#  Event/Celebration Management
		#----------------------------------------------------------------
	    Route::group(['middleware' => ['SubAdminAuth:event-type-management,read_permission']], function() {
			Route::get('/events','Admin\EventController@index')->name('list_events');
			Route::get('/event/ajax','Admin\EventController@ajax_getEvent')->name('ajax_getEvents');
		});

		Route::group(['middleware' => ['SubAdminAuth:event-type-management,write_permission']], function() {
			Route::get('/event/create','Admin\EventController@create')->name('create_event_type');
			Route::post('/event/create','Admin\EventController@store')->name('store_events');
			Route::get('/event/edit/{slug}','Admin\EventController@edit')->name('edit_event');
			Route::post('/event/edit/{slug}','Admin\EventController@update')->name('update_event');
			Route::get('/event/status/{slug}','Admin\EventController@event_status')->name('event_status');
			Route::get('/event/type/{slug}','Admin\EventController@event_budget_catagories')->name('event_budget_catagories');
			Route::get('/event/categories/ajax','Admin\EventController@ajax_getCategories')->name('ajax_getCategories');
			Route::get('/event/type/catagory/{slug}','Admin\EventController@event_budget_subcatagories')->name('event_budget_subcatagories');
			Route::post('/event/type/budget/update/{slug}','Admin\EventController@budgetUpdate')->name('update_budget');
		});

		Route::group(['middleware' => ['SubAdminAuth:group-management,read_permission']], function() {
			Route::get('/group','Admin\GroupController@index')->name('list_groups');
			Route::get('/group/ajax','Admin\GroupController@ajax_getGroup')->name('ajax_getGroups');
		});

		Route::group(['middleware' => ['SubAdminAuth:group-management,write_permission']], function() {
			Route::get('/group/create','Admin\GroupController@create')->name('create_group');
			Route::post('/group/create','Admin\GroupController@store')->name('store_group');
			Route::get('/group/edit/{slug}','Admin\GroupController@edit')->name('edit_group');
			Route::post('/group/edit/{slug}','Admin\GroupController@update')->name('update_group');
			Route::get('/group/status/{slug}','Admin\GroupController@group_status')->name('group_status');
		});
		#----------------------------------------------------------------
		#  Amenities/Games Management
		#----------------------------------------------------------------
		// GAMES
		Route::group(['middleware' => ['SubAdminAuth:amenities-management,read_permission']], function() {
			Route::get('/amenities','Admin\AmenityGamesController@index')->name('list_amenities');
		});
		Route::group(['middleware' => ['SubAdminAuth:amenities-management,write_permission']], function() {
			Route::get('/amenities/create','Admin\AmenityGamesController@create')->name('create_amenities_type');
			Route::post('/amenities/create','Admin\AmenityGamesController@store')->name('store_amenities');
			Route::get('/amenities/ajax','Admin\AmenityGamesController@ajax_getAmenity')->name('ajax_getAmenity');
		});
		//  games
		Route::group(['middleware' => ['SubAdminAuth:games-management,read_permission']], function() {
			Route::get('/games','Admin\AmenityGamesController@game_index')->name('list_games');
			Route::get('/games/ajax','Admin\AmenityGamesController@ajax_getGames')->name('ajax_getGames');
		});
		Route::group(['middleware' => ['SubAdminAuth:games-management,write_permission']], function() {
			Route::get('/amenities/edit/{slug}','Admin\AmenityGamesController@edit')->name('edit_amenity');
			Route::post('/amenities/edit/{slug}','Admin\AmenityGamesController@update')->name('update_amenity');
			Route::get('/amenities/status/{slug}','Admin\AmenityGamesController@amenity_status')->name('amenity_status');
		});



		#----------------------------------------------------------------
		#  Event/Celebration Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:seasons-management,read_permission']], function() {
			Route::get('/seasons','Admin\SeasonController@index')->name('list_seasons');
			Route::get('/seasons/ajax','Admin\SeasonController@ajax_getEvent')->name('ajax_getSeasons');
		});
		Route::group(['middleware' => ['SubAdminAuth:seasons-management,write_permission']], function() {
			Route::get('/seasons/create','Admin\SeasonController@create')->name('create_seasons');
			Route::post('/seasons/create','Admin\SeasonController@store')->name('store_seasons');
			Route::get('/seasons/edit/{slug}','Admin\SeasonController@edit')->name('edit_seasons');
			Route::post('/seasons/edit/{slug}','Admin\SeasonController@update')->name('update_seasons');
			Route::get('/seasons/status/{slug}','Admin\SeasonController@event_status')->name('seasons_status');
		});


		#----------------------------------------------------------------
		#  User/Vendor Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:user-management,read_permission']], function() {
			Route::get('/users','Admin\UserController@index')->name('list_users');
			Route::get('/users/ajax_getUsers','Admin\UserController@ajax_getUsers')->name('ajax_getUsers');
		});
		Route::group(['middleware' => ['SubAdminAuth:vendor-management,read_permission']], function() {
			Route::get('/vendors','Admin\VendorController@index')->name('list_vendors');
			Route::get('/vendors/ajax_getVendors','Admin\VendorController@ajax_getVendors')->name('ajax_getVendors');
			Route::get('/vendors/business/{id}','Admin\VendorController@business')->name('admin_vendor_business');
		});
		Route::group(['middleware' => ['SubAdminAuth:user-management,write_permission']], function() {
			Route::get('/vendors/changeStatus/{id}','Admin\VendorController@changeStatus')->name('admin_vendor_changeStatus');
			Route::get('/vendors/business/changeBusinessStatus/{user_id}/{ven_cat_id}/{status}','Admin\VendorController@changeBusinessStatus')->name('admin_vendor_business_changeBusinessStatus');
		});
		#----------------------------------------------------------------
		#  Venue Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:businesses-listing,read_permission']], function() {
			Route::get('/businesses', 'Admin\BusinessController@index')->name('admin.business.index');
			Route::get('/businesses/ajax_getBusinesses/{status}', 'Admin\BusinessController@ajax_getBusinesses')->name('admin.business.ajax_getBusinesses');
		});
		Route::group(['middleware' => ['SubAdminAuth:businesses-listing,write_permission']], function() {
			Route::get('/businesses/changeBusinessesStatus/{ven_cat_id}/{status}', 'Admin\BusinessController@changeBusinessesStatus')->name('admin_business_changeBusinessesStatus');

			Route::post('/vendors/business/rejectBusinessStatus/{user_id}/{service_id}','Admin\BusinessController@rejectBusinessStatus')->name('admin_vendor_business_rejectBusinessStatus');
		});

		#----------------------------------------------------------------
		#  Venue Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:venues-management,read_permission']], function() {
			Route::get('/venues','Admin\VenueController@index')->name('admin.venues.list');
			Route::get('/venues/ajax_getVenues','Admin\VenueController@ajax_getVenues')->name('admin.venues.ajax_getVenues');
		});
		Route::group(['middleware' => ['SubAdminAuth:venues-management,write_permission']], function() {
			Route::get('/venues/create','Admin\VenueController@showCreate')->name('admin.venues.showCreate');
			Route::post('/venues/create','Admin\VenueController@create')->name('admin.venues.create');
			Route::get('/venues/{slug}','Admin\VenueController@showEdit')->name('admin.venues.showEdit');
			Route::post('/venues/{slug}','Admin\VenueController@update')->name('admin.venues.update');
			Route::get('/venues/status/{slug}','Admin\VenueController@venueStatus')->name('admin.venues.status');
		});

		#----------------------------------------------------------------
		#  Style Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:styles-management,read_permission']], function() {
			Route::get('/styles','Admin\StyleController@index')->name('admin.styles.list');
			Route::get('/styles/ajax_getStyles','Admin\StyleController@ajax_getStyles')->name('admin.styles.ajax_getStyles');
		});
		Route::group(['middleware' => ['SubAdminAuth:styles-management,write_permission']], function() {
			Route::get('/styles/create','Admin\StyleController@showCreate')->name('admin.styles.showCreate');
			Route::post('/styles/create','Admin\StyleController@create')->name('admin.styles.create');
			Route::get('/styles/{slug}','Admin\StyleController@showEdit')->name('admin.styles.showEdit');
			Route::post('/styles/{slug}','Admin\StyleController@update')->name('admin.styles.update');
			Route::get('/styles/status/{slug}','Admin\StyleController@styleStatus')->name('admin.styles.status');
		});
        


        #------------------------------------------------------------------------------------
        #  General Settings
        #------------------------------------------------------------------------------------

		Route::group(['middleware' => ['SubAdminAuth:page-management,read_permission']], function() {
        	Route::get('/settings/general', 'Admin\GeneralSettingController@index')->name('list_general_settings');
	        Route::get('/settings/general/ajax', 'Admin\GeneralSettingController@ajaxData')->name('list_general_ajax_settings');
        });
        Route::group(['middleware' => ['SubAdminAuth:page-management,write_permission']], function() {	
	        Route::post('/settings/general', 'Admin\GeneralSettingController@typeStore')->name('list_general_settings');
	        Route::get('/settings/general/edit/{id}', 'Admin\GeneralSettingController@add')->name('add_general_settings');
	        Route::post('/settings/general/edit/{id}', 'Admin\GeneralSettingController@store')->name('add_general_settings');
        	Route::get('/ajax/settings/general/upload', 'Admin\GeneralSettingController@MetaImage')->name('meta_images');
	    });
        // payment Setting
        Route::group(['middleware' => ['SubAdminAuth:payment-management,read_permission']], function() {
        	Route::get('/settings/payment', 'Admin\GeneralSettingController@payments')->name('list_payment_settings');
        });
        Route::group(['middleware' => ['SubAdminAuth:payment-management,write_permission']], function() {
        	Route::post('/settings/payment', 'Admin\GeneralSettingController@updatePayments')->name('list_payment_settings');
        });
        // global Setting
        Route::group(['middleware' => ['SubAdminAuth:global-management,read_permission']], function() {
        	Route::get('/settings/global', 'Admin\GeneralSettingController@global')->name('global_settings');
        });
        Route::group(['middleware' => ['SubAdminAuth:global-management,write_permission']], function() {
        	Route::post('/settings/global', 'Admin\GeneralSettingController@updateGlobal')->name('global_settings');
        });
        Route::group(['middleware' => ['SubAdminAuth:commission-management,read_permission']], function() {
	        Route::get('/commission/settings', 'Admin\CommissionController@fee')->name('admin.commission');
	    });
	    Route::group(['middleware' => ['SubAdminAuth:commission-management,write_permission']], function() { 
	        Route::get('/commission/settings/{id}', 'Admin\CommissionController@delete')->name('admin.commissionDelete');
	        Route::post('/commission/settings', 'Admin\CommissionController@store')->name('admin.commission');
	    });

        #------------------------------------------------------------------------------------
        #  Cms Page
        #------------------------------------------------------------------------------------
        Route::group(['middleware' => ['SubAdminAuth:cms-pages-management,read_permission']], function() {
	        Route::get('/pages', 'Admin\CmsPageController@index')->name('admin.cms-pages.list');
	        Route::get('/pages/ajaxData', 'Admin\CmsPageController@ajaxData')->name('admin.cms-pages.ajaxData');
	    });
	    Route::group(['middleware' => ['SubAdminAuth:cms-pages-management,write_permission']], function() {
	        Route::get('/pages/create', 'Admin\CmsPageController@showCreate')->name('admin.cms-pages.showCreate');
	        Route::post('/pages/create', 'Admin\CmsPageController@create')->name('admin.cms-pages.create');
	        Route::get('/pages/{slug}', 'Admin\CmsPageController@edit')->name('admin.cms-pages.edit');
	        Route::post('/pages/{slug}', 'Admin\CmsPageController@update')->name('admin.cms-pages.update');
	        Route::get('/pages/status/{slug}', 'Admin\CmsPageController@changeStatus')->name('admin.cms-pages.status');
	    });
        #------------------------------------------------------------------------------------
        #  Thankyou Templates 
        #------------------------------------------------------------------------------------
        Route::group(['middleware' => ['SubAdminAuth:thank-you-templates-management,read_permission']], function() {
        	Route::get('/thank-you-templates', 'Admin\ThankyouTemplatesController@index')->name('admin.thank-you-template.list');
	        Route::get('/thank-you-templates/ajaxData', 'Admin\ThankyouTemplatesController@ajaxData')->name('admin.thank-you-template.ajaxData');
    	});
        Route::group(['middleware' => ['SubAdminAuth:thank-you-templates-management,write_permission']], function() {
	        Route::get('/thank-you-templates/create', 'Admin\ThankyouTemplatesController@showCreate')->name('admin.thank-you-template.showCreate');
	        Route::post('/thank-you-templates/create', 'Admin\ThankyouTemplatesController@create')->name('admin.thank-you-template.create');
	        Route::get('/thank-you-templates/{id}', 'Admin\ThankyouTemplatesController@edit')->name('admin.thank-you-template.edit');
	        Route::post('/thank-you-templates/{id}', 'Admin\ThankyouTemplatesController@update')->name('admin.thank-you-template.update');
	        Route::get('/thank-you-templates/status/{id}', 'Admin\ThankyouTemplatesController@changeStatus')->name('admin.thank-you-template.status');
	    });

        #------------------------------------------------------------------------------------
        #  Faq
        #------------------------------------------------------------------------------------
        Route::group(['middleware' => ['SubAdminAuth:faq-management,read_permission']], function() {
        	Route::get('/{type}/faqs', 'Admin\FaqController@index')->name('admin.faqs.lists');
        });
        // Route::get('/faqs/ajaxData/{type}', 'Admin\FaqController@ajaxData')->name('admin.faqs.ajaxData');
        Route::group(['middleware' => ['SubAdminAuth:faq-management,write_permission']], function() {
	        Route::get('/{type}/faqs/create', 'Admin\FaqController@showCreate')->name('admin.faqs.showCreate');
	        Route::post('/{type}/faqs/create', 'Admin\FaqController@create')->name('admin.faqs.create');
	        Route::get('/{type}/faqs/{id}', 'Admin\FaqController@edit')->name('admin.faqs.edit');
	        Route::post('/{type}/faqs/{id}', 'Admin\FaqController@update')->name('admin.faqs.update');
	        Route::get('/{type}/faqs/delete/{id}', 'Admin\FaqController@delete')->name('admin.faqs.delete');
	        Route::get('/{type}/faqs/status/{id}', 'Admin\FaqController@changeStatus')->name('admin.faqs.status');
	    });

        
        Route::get('/my-business/{slug}/{vendorSlug}', 'Vendor\MyBusinessController@index')->name('vendorBusinessView');


        // Email Management

        #-------------------------------------------------------------------------------------------------------------
        #  Email Templates
        #-------------------------------------------------------------------------------------------------------------

        
        Route::group(['middleware' => ['SubAdminAuth:business-email-management,read_permission']], function() {
        	Route::get('/email-management', 'Admin\EmailManagementController@index')->name('admin.emails.index');
        });
        Route::group(['middleware' => ['SubAdminAuth:business-email-management,write_permission']], function() {
        	Route::post('/email-management', 'Admin\EmailManagementController@create')->name('admin.emails.index');
        	Route::get('/email-management/{id}', 'Admin\EmailManagementController@edit')->name('admin.emails.update');
        	Route::post('/email-management/{id}', 'Admin\EmailManagementController@update')->name('admin.emails.update');
    	});

        #-------------------------------------------------------------------------------------------------------------
        #  admin.orders
        #-------------------------------------------------------------------------------------------------------------
        Route::group(['middleware' => ['SubAdminAuth:order-management,read_permission']], function() {
        	Route::get('/orders','Admin\OrderController@index')->name('admin.orders');
        	Route::get('/orders/detail/{id}','Admin\OrderController@detail')->name('admin.orderDetail');
        	Route::get('/orders/ajax','Admin\OrderController@ajax')->name('admin.ajaxOrders');
        });
        Route::group(['middleware' => ['SubAdminAuth:escrow-management,read_permission']], function() {
        	Route::get('/escrow','Admin\OrderController@escrowListing')->name('admin.escrow');
        	Route::get('/escrow/ajax','Admin\OrderController@escrowajax')->name('admin.ajaxescrow');
        });
       #--------------------------------------------------------------------------------------------------------------
       #  Vendors
       #--------------------------------------------------------------------------------------------------------------
        Route::group(['middleware' => ['SubAdminAuth:vendor-invite-list,read_permission']], function() {
	     	Route::get('/inviting/vendors','Admin\VendersController@invite')->name('admin.vendor.invite');
	     	Route::get('/inviting/vendor/{id}','Admin\VendersController@inviteDetail')->name('admin.vendor.inviting');
	     });
	    Route::group(['middleware' => ['SubAdminAuth:vendor-invite-list,write_permission']], function() {
	     	Route::get('/inviting/vendor/request/{id}','Admin\VendersController@vendorInvite')->name('admin.vendorInvite');
	    });


       #--------------------------------------------------------------------------------------------------------------
       #  users
       #--------------------------------------------------------------------------------------------------------------
       	Route::group(['middleware' => ['SubAdminAuth:user-invite-list,read_permission']], function() {
			Route::get('/inviting/users','Admin\VendersController@invite2')->name('admin.user.invite');
			Route::get('/inviting/user/{id}','Admin\VendersController@inviteDetail2')->name('admin.user.inviting');
		});

		Route::group(['middleware' => ['SubAdminAuth:user-invite-list,write_permission']], function() {	
			Route::get('/inviting/user/request/{id}','Admin\VendersController@vendorInvite2')->name('admin.userInvite');
		});

		Route::group(['middleware' => ['SubAdminAuth:new-vendors-management,read_permission']], function() {
			Route::get('/vendors/new','Admin\VendersController@index')->name('admin.vendor.list');
			Route::get('/vendors/ajax-new-vendors','Admin\VendersController@ajax_getVendors')->name('ajax-new-vendors');
		});

		Route::group(['middleware' => ['SubAdminAuth:new-vendors-management,write_permission']], function() {
			Route::get('/vendors/ajax-inviting-vendors','Admin\VendersController@ajax_getInvitingVendors')->name('ajax_getInvitingVendors');
		});


       #--------------------------------------------------------------------------------------------------------------
       #  users
       #--------------------------------------------------------------------------------------------------------------
       
		Route::group(['middleware' => ['SubAdminAuth:new-vendors-management,read_permission']], function() {
			Route::get('/vendors/new/{id}','Admin\VendersController@detail')->name('admin.vendor.detail');
	    });
	    Route::group(['middleware' => ['SubAdminAuth:new-vendors-management,write_permission']], function() { 
	        Route::get('/vendors/approved/{id}','Admin\VendersController@approved')->name('admin.vendor.approved');
			Route::post('/vendors/rejected/{id}','Admin\VendersController@rejected')->name('admin.vendor.rejected');
		});

       #--------------------------------------------------------------------------------------------------------------
       #  users
       #--------------------------------------------------------------------------------------------------------------
       

	    Route::group(['middleware' => ['SubAdminAuth:dispute-management,read_permission']], function() {
			Route::get('/vendor/disputes','Admin\DisputeController@index')->name('admin.vendor.dispute');
			Route::get('/vendor/disputes/ajax','Admin\DisputeController@ajax')->name('admin.vendor.dispute.ajax');
			Route::get('/vendor/disputes/{id}','Admin\DisputeController@detail')->name('admin.vendor.dispute.detail');
		});

		Route::group(['middleware' => ['SubAdminAuth:dispute-management,write_permission']], function() {
			Route::get('/vendor/disputes/{id}/block','Admin\DisputeController@block')->name('admin.vendor.dispute.block');
		});

		Route::group(['middleware' => ['SubAdminAuth:forum-groups-management,write_permission']], function() {
			Route::get('/forum-groups','Admin\ForumGroupController@index')->name('list_forum_groups');
			Route::get('/forum-group/ajax','Admin\ForumGroupController@ajax_getforum_groups')->name('ajax_getforum_groups');
		});
		Route::group(['middleware' => ['SubAdminAuth:forum-groups-management,write_permission']], function() {
			Route::get('/forum-group/create','Admin\ForumGroupController@create')->name('create_forum_group');
			Route::post('/forum-group/create','Admin\ForumGroupController@store')->name('store_forum_group');
			Route::get('/forum-groups/edit/{slug}','Admin\ForumGroupController@edit')->name('edit_forum_group');
			Route::post('/forum-groups/edit/{slug}','Admin\ForumGroupController@update')->name('update_forum_group');
			Route::get('/forum-groups/status/{slug}','Admin\ForumGroupController@group_status')->name('forum_group_status');
		});

		Route::group(['middleware' => ['SubAdminAuth:news-management,read_permission']], function() {
			Route::get('/news-offers/{type}', 'Admin\NewsOffersController@index')->name('admin.newsoffers.lists');
		});
        // Route::get('/faqs/ajaxData/{type}', 'Admin\FaqController@ajaxData')->name('admin.faqs.ajaxData');
        Route::group(['middleware' => ['SubAdminAuth:news-management,write_permission']], function() {
	        Route::get('/news-offers/{type}/create', 'Admin\NewsOffersController@showCreate')->name('admin.newsoffers.showCreate');
	        Route::post('/news-offers/{type}/create', 'Admin\NewsOffersController@create')->name('admin.newsoffers.create');
	        Route::get('/news-offers/{type}/{id}', 'Admin\NewsOffersController@edit')->name('admin.newsoffers.edit');
	        Route::post('/news-offers/{type}/{id}', 'Admin\NewsOffersController@update')->name('admin.newsoffers.update');
	        Route::get('/news-offers/{type}/delete/{id}', 'Admin\NewsOffersController@delete')->name('admin.newsoffers.delete');
	        Route::get('/news-offers/{type}/status/{id}', 'Admin\NewsOffersController@changeStatus')->name('admin.newsoffers.status');
	    });

        Route::group(['middleware' => ['SubAdminAuth:testimonial-management,read_permission']], function() {
	        Route::get('/testimonials','Admin\TestimonialController@index')->name('list_testimonials');
			Route::get('/testimonial/ajax','Admin\TestimonialController@ajax_gettestimonials')->name('ajax_gettestimonials');
	    });

	    Route::group(['middleware' => ['SubAdminAuth:testimonial-management,write_permission']], function() {
			Route::get('/testimonial/create','Admin\TestimonialController@create')->name('create_testimonial');
			Route::post('/testimonial/create','Admin\TestimonialController@store')->name('store_testimonial');
			Route::get('/testimonial/edit/{id}','Admin\TestimonialController@edit')->name('edit_testimonial');
			Route::post('/testimonial/edit/{id}','Admin\TestimonialController@update')->name('update_testimonial');
			Route::get('/testimonial/status/{id}','Admin\TestimonialController@testimonial_status')->name('testimonial_status');
		});


	    Route::group(['middleware' => ['SubAdminAuth:review-management,read_permission']], function() {
			Route::get('/reviews','Users\BusinessReviewsController@index1')->name('list_reviews');
			Route::get('/review/ajax','Users\BusinessReviewsController@ajax_getreviews')->name('ajax_getreviews');
		});

		Route::group(['middleware' => ['SubAdminAuth:review-management,write_permission']], function() {
			Route::get('/review/edit/{id}','Users\BusinessReviewsController@edit')->name('edit_review');
			Route::post('/review/edit/{id}','Users\BusinessReviewsController@update')->name('update_review');
			Route::get('/review/status/{id}','Users\BusinessReviewsController@review_status')->name('review_status');
		});
       #--------------------------------------------------------------------------------------------------------------
       #  users
       #--------------------------------------------------------------------------------------------------------------

		#----------------------------------------------------------------
		#  Menu Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:menu-management,read_permission']], function() {
			Route::get('/menu','Admin\MenuController@index')->name('admin.menu.list');
			Route::get('/menu/ajax_getMenu','Admin\MenuController@ajax_getMenu')->name('admin.menu.ajax_getMenu');
		});

		Route::group(['middleware' => ['SubAdminAuth:menu-management,write_permission']], function() {
			Route::get('/menu/create', 'Admin\MenuController@showCreate')->name('admin.menu.create');
			Route::post('/menu/create','Admin\MenuController@create')->name('admin.menu.create');
			Route::get('/menu/{slug}','Admin\MenuController@showEdit')->name('admin.menu.showEdit');
			Route::post('/menu/{slug}','Admin\MenuController@update')->name('admin.menu.update');
			Route::get('/menu/status/{slug}','Admin\MenuController@menuStatus')->name('admin.menu.status');
		});
		#----------------------------------------------------------------
		#  subadmin Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:sub-admin-management,read_permission']], function() {
			Route::get('/subadmin','Admin\AdminController@subadmin_index')->name('admin.subadmin.list');
			Route::get('/subadmin/ajax_getSubadmin','Admin\AdminController@ajax_getSubadmin')->name('admin.subadmin.ajax_getSubadmin');
		});
		Route::group(['middleware' => ['SubAdminAuth:sub-admin-management,write_permission']], function() {
			Route::get('/subadmin/create', 'Admin\AdminController@showCreate')->name('admin.subadmin.create');
			Route::post('/subadmin/create','Admin\AdminController@create')->name('admin.subadmin.create');
	       	Route::get('/subadmin/{id}','Admin\AdminController@showEdit')->name('admin.subadmin.showEdit');
			Route::post('/subadmin/{id}','Admin\AdminController@update')->name('admin.subadmin.update');
			Route::get('/subadmin/status/{id}','Admin\AdminController@subadminStatus')->name('admin.subadmin.status');
		});

		#----------------------------------------------------------------
		#  Coupon management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:coupon-management,read_permission']], function() {
			Route::get('/coupon','Admin\CouponController@index')->name('admin.coupon.list');
			Route::get('/coupon/ajax_getCoupon','Admin\CouponController@ajax_getCoupon')->name('admin.coupon.ajax_getCoupon');
		});
		Route::group(['middleware' => ['SubAdminAuth:coupon-management,write_permission']], function() {
			Route::get('/coupon/create', 'Admin\CouponController@showCreate')->name('admin.coupon.create');
			Route::post('/coupon/create','Admin\CouponController@create')->name('admin.coupon.create');
			Route::get('/coupon/{slug}','Admin\CouponController@showEdit')->name('admin.coupon.showEdit');
			Route::post('/coupon/{slug}','Admin\CouponController@update')->name('admin.coupon.update');
			Route::get('/coupon/status/{slug}','Admin\CouponController@couponStatus')->name('admin.coupon.status');
			
		});
		#----------------------------------------------------------------
		#  Vendor Commission Fee 
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:vendor-commission-fee,read_permission']], function() {
			Route::get('/commission','Admin\VendorCommissionController@index')->name('admin.commission.list');
			Route::get('/commission/ajax_getVendorscommission','Admin\VendorCommissionController@ajax_getVendorscommission')->name('admin.commission.ajax_getVendorscommission');
			
			
	     });
		Route::group(['middleware' => ['SubAdminAuth:vendor-commission-fee,write_permission']], function() {
			Route::get('/commission/vendor_fee/{id}', 'Admin\VendorCommissionController@vendor_commission_fee')->name('set_commission');
			Route::post('/commission/vendor_fee/{id}', 'Admin\VendorCommissionController@store')->name('admin.commission.vendor_fee');
			Route::get('/commission/business/{id}','Admin\VendorCommissionController@business')->name('admin.commission.admin_vendor_business');
			Route::get('/commission/status/{id}','Admin\VendorCommissionController@changeStatus')->name('vendor_status');
			  Route::get('/commission/vendor_commission/{id}', 'Admin\VendorCommissionController@delete')->name('admin.commissionDelete1');
	        
		});
		#----------------------------------------------------------------
		#  Subadmn Group Management
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:subadmin-group-management,read_permission']], function() {
			Route::get('/groups','Admin\GroupsController@index')->name('admin.group.list');
			Route::get('/groups/ajax_getsubadmingroup','Admin\GroupsController@ajax_getsubadmingroup')->name('admin.group.ajax_getsubadmingroup');
		});

		Route::group(['middleware' => ['SubAdminAuth:subadmin-group-management,write_permission']], function() {
			Route::get('/groups/create', 'Admin\GroupsController@showCreate')->name('admin.group.create');
			Route::post('/groups/create','Admin\GroupsController@create')->name('admin.group.create');
			Route::get('/groups/{slug}','Admin\GroupsController@showEdit')->name('admin.group.showEdit');
			Route::post('/groups/{slug}','Admin\GroupsController@update')->name('admin.group.update');
			Route::get('/groups/status/{slug}','Admin\GroupsController@groupStatus')->name('admin.group.status');
		});

		#----------------------------------------------------------------
		#  CMS Menu Management
		#----------------------------------------------------------------

		    Route::group(['middleware' => ['SubAdminAuth:cms-menu-management,read_permission']], function() {
	        Route::get('/cms-menu', 'Admin\CmsMenuController@index')->name('admin.cms-menu.list');
	    });
	    Route::group(['middleware' => ['SubAdminAuth:cms-menu-management,write_permission']], function() {
	        Route::get('/cms-menu/create', 'Admin\CmsMenuController@showCreate')->name('admin.cms-menu.showCreate');
	        Route::post('/cms-menu/create', 'Admin\CmsMenuController@create')->name('admin.cms-menu.create');
	        Route::get('/cms-menu/delete/{id}','Admin\CmsMenuController@delete')->name('delete_cmsmenu');
	        Route::get('/cms-menu/edit/{id}','Admin\CmsMenuController@edit')->name('edit_cmsmenu');
	        Route::post('/cms-menu/edit/{id}','Admin\CmsMenuController@update')->name('update_cmsmenu');
	        
	    });
	    #----------------------------------------------------------------
		#  Dispute Managment
		#----------------------------------------------------------------
	    Route::group(['middleware' => ['SubAdminAuth:disputes,read_permission']], function() {
	    Route::get('/dispute', 'Admin\DisputeController@disputelist')->name('admin.dispute-chat.index');
	    Route::get('/dispute/ajax','Admin\DisputeController@disputeajax')->name('admin.dispute.ajax');
	    });
	    Route::group(['middleware' => ['SubAdminAuth:disputes,write_permission']], function() {
        Route::get('/dispute/{id}', 'Admin\DisputeController@disputedetail')->name('admin.disputeDetail');
        Route::post('/dispute/{id}', 'Admin\DisputeController@disputecreate')->name('admin.disputeDetail');
         });
	    #----------------------------------------------------------------
		#  Dispute Reason
		#----------------------------------------------------------------
		Route::group(['middleware' => ['SubAdminAuth:dispute-reason,read_permission']], function() {
			Route::get('/dispute-reason','Admin\DisputeReasonController@index')->name('admin.dispute-reason.index');
			Route::get('/dispute-reason/ajax_getDisputeReason','Admin\DisputeReasonController@ajax_getDisputeReason')->name('admin.dispute-reason.ajax_getDisputeReason');
		});

		Route::group(['middleware' => ['SubAdminAuth:dispute-reason,write_permission']], function() {
			Route::get('/dispute-reason/create', 'Admin\DisputeReasonController@showCreate')->name('admin.dispute-reason.create');
			Route::post('/dispute-reason/create','Admin\DisputeReasonController@create')->name('admin.dispute-reason.create');
			Route::get('/dispute-reason/{slug}','Admin\DisputeReasonController@showEdit')->name('admin.dispute-reason.showEdit');
			Route::post('/dispute-reason/{slug}','Admin\DisputeReasonController@update')->name('admin.dispute-reason.update');
			Route::get('/dispute-reason/status/{slug}','Admin\DisputeReasonController@menuStatus')->name('admin.dispute-reason.status');
		});



});
