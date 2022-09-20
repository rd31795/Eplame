<?php
 Route::group(['middleware' => ['UserAuth'],'prefix' => 'user'], function() {
         require __DIR__.'/tools/routes.php';

         Route::get('/', 'Users\DashboardController@index')->name('user_dashboard');
         Route::get('/statistics', 'Users\DashboardController@stats')->name('user_stats'); 
         Route::get('/profile', 'Users\DashboardController@profile')->name('user_profile'); 
         Route::post('/profile', 'Users\DashboardController@updateProfile'); 
         Route::get('/become-a-vendor/form', 'Users\DashboardController@vendorForm')->name('become-a-vendor');
         Route::post('/become-a-vendor', 'Users\DashboardController@userAsVendor')->name('user_as_vendor');
         Route::post('/cohost/invite','Users\UserEventController@cohostInvitation')->name('cohost_invitation');
         Route::get('/thanks/{id}/{status}','Users\UserEventController@coHostThanks')->name('cohost_invitation_thanks');
          Route::post('/profile/deactivate', 'Users\DashboardController@profile_deactivation')->name('profile_deactivation');
         #-----------------------------------------------------------------------------------
         #  Event Management ----------------------------------------------------------------
         #-----------------------------------------------------------------------------------

          Route::get('/events', 'Users\UserEventController@index')->name('user_events');
          Route::get('/events/{id}', 'Users\UserEventController@index')->name('user_event');

          Route::get('/co-events', 'Users\UserEventController@coHostEvents')->name('user_co_events');
          Route::get('/co-events/{status}', 'Users\UserEventController@coHostEvents')->name('user_co_event');
          Route::get('/event/co-host/edit/{id}', 'Users\UserEventController@editCoHost')->name('user_edit_co_host');
          Route::post('/event/co-host/edit/{id}', 'Users\UserEventController@updateCoHost')->name('user_update_co_host');
          Route::get('/event/create', 'Users\UserEventController@showCreateEvent')->name('user_show_create_event');
          Route::post('/event/create', 'Users\UserEventController@create')->name('user_show_create_event');
           Route::get('/event/eventType', 'Users\UserEventController@eventType')->name('user_event_type');
           Route::get('/event/inpersonEvent/', 'Users\UserEventController@inpersonEvent')->name('user_in_person_event');
           Route::get('/event/virtualEvent/{id}', 'Users\UserEventController@virtualEvent')->name('user_virtual_event');
           Route::get('/event/hybridEvent', 'Users\UserEventController@hybridEvent')->name('user_hybrid_event');
          Route::get('/events/edit/{slug}', 'Users\UserEventController@showEditEvent')->name('user_show_edit_event');
          Route::get('/events/editVirtualHybrid/{slug}', 'Users\UserEventController@showEditVirtualHybridEvent')->name('user_show_edit_virtual_hybrid_event');
           Route::get('/event/inpersonEvent/getImage','Users\UserEventController@getImage')->name('user.event.getimage');
           Route::get('/event/hybridEvent/getTemplate','Users\UserEventController@getTemplate')->name('user.event.gettemplate');
           Route::get('/event/inpersonEvent/getEventType','Users\UserEventController@getEventType')->name('user.event.getEventType');
          Route::get('/events/reschedule/{slug}', 'Users\UserEventController@showEditRechedule')->name('user_reschedule_event');
          Route::post('/events/reschedule/{slug}', 'Users\UserEventController@rescheduleEvent')->name('user_reschedule_event');
          Route::get('/co-events/edit/{slug}', 'Users\UserEventController@showEditEvent')->name('user_show_edit_co_event');
          Route::get('/events/detail/{slug}', 'Users\UserEventController@showDetailEvent')->name('user_show_detail_event');
          Route::get('/events/detailEvent/{slug}', 'Users\UserEventController@showVirtualHydridDetailEvent')->name('show_virtual_hybrid_detail_event');
          Route::get('/co-events/detail/{slug}', 'Users\UserEventController@showDetailEvent')->name('user_show_detail_co_event');
          Route::get('/hitesh-event', 'Users\UserEventController@hiteshEvent')->name('hitesh_event');
          Route::post('/events/edit/{slug}', 'Users\UserEventController@update')->name('user_show_edit_event');
          Route::post('/events/editVirtualHybrid/{slug}', 'Users\UserEventController@updateVirtualHybridEvent')->name('user_show_edit_virtual_hybrid_event');
          Route::post('/events/update/{slug}', 'Users\UserEventController@eventExtraDetail')->name('eventExtraDetail');


             Route::get('/events/{slug}/album', 'Users\UserEventController@album')->name('user.event.album');
             Route::get('/events/{slug}/{id}/album/delete', 'Users\UserEventController@albumDelete')->name('user.event.album.delete');
             Route::post('/events/{slug}/album', 'Users\UserEventController@postAlbum')->name('user.event.album');
           Route::get('/events/{slug}/album/ajax', 'Users\UserEventController@album_ajax')->name('user.event.album.ajax');


         #---------------------------------------------------------------------------------
         #  Ticket Management -------------------------------------------------------------
         #---------------------------------------------------------------------------------

          Route::get('/events/ticket/edit_design/{id}','Users\UserEventController@ticketDesign')->name('user.event.ticket_design');
          Route::post('/events/ticket/edit_ticket/{id}','Users\UserEventController@editTicketDesign')->name('event-ticket-update');


         #-----------------------------------------------------------------------------------
         #  Event Management ----------------------------------------------------------------
         #-----------------------------------------------------------------------------------
          
          Route::get('/favourite-vendors/{id}', 'Users\DashboardController@addFavouriteVendors')->name('user_add_favourite_vendors');
          Route::get('/favourite-vendors', 'Users\DashboardController@favouriteVendors')->name('user_show_favourite_vendors');
          Route::get('/favourite-vendors/delete/{id}', 'Users\DashboardController@deleteFavouriteVendor')->name('user_delete_favourite_vendors');


         Route::get('/messages/chats', 'Users\ChatController@index')->name('deal_discount_chats'); 
         Route::get('/messages/chat/{id}', 'Users\ChatController@chat')->name('deal_discount_chatMessages'); 

         #-----------------------------------------------------------------------------------
         #  Event Management ----------------------------------------------------------------
         #-----------------------------------------------------------------------------------


         #-----------------------------------------------------------------------------------
         #  Orders Management ----------------------------------------------------------------
         #-----------------------------------------------------------------------------------


          Route::get('/orders', 'Users\UserOrderController@index')->name('user_orders'); 
          Route::get('/escrow_listing', 'Users\UserOrderController@escrowListing')->name('user_escrow'); 
          Route::get('/order/{orderID}/detail', 'Users\UserOrderController@orderDetail')->name('order_details');

          
          Route::get('/orders/event/{orderID}', 'Users\UserEventController@dispute')->name('user.event.dispute');
          Route::post('/orders/event/{orderID}', 'Users\UserEventController@disputePost')->name('user.event.dispute');


          Route::get('/orders/event/review/{orderID}', 'Users\UserEventController@dispute')->name('user.event.review');
          Route::post('/orders/event/review/{orderID}', 'Users\UserEventController@disputePost')->name('user.event.review');
         #-----------------------------------------------------------------------------------
         #  Orders Management ----------------------------------------------------------------
         #-----------------------------------------------------------------------------------


          Route::get('shop/orders', 'Users\ShopOrderController@index')->name('users.shop.orders'); 
          Route::get('shop/{orderID}/buy-it-again','Users\ShopOrderController@buyItAgain')->name('users.shop.order.buy_it_again');

          Route::get('shop/order/{orderID}/detail', 'Users\ShopOrderController@orderDetail')
               ->name('users.shop.order.detail'); 

           Route::get('shop/order/review/{order_id}/{item_id}/create',
                      'Users\ShopOrderController@addReview'
                      )->name('users.shop.order.review');

          Route::post('shop/order/review/{order_id}/{item_id}/create',
                      'Users\ShopOrderController@saveReview'
                      )->name('users.shop.order.review');


           #-----------------------------------------------------------------------------------
           #  Inviting Vendors ----------------------------------------------------------------
           #-----------------------------------------------------------------------------------
   
          Route::get('/inviting-vendors', 'Users\VendorsController@index')->name('user.inviting.vendors'); 
          Route::get('/inviting-vendor', 'Users\VendorsController@add')->name('users.invite.newVendor'); 
          Route::post('/inviting-vendor', 'Users\VendorsController@store')->name('users.invite.newVendor'); 


           #-----------------------------------------------------------------------------------
           #  Inviting Vendors ----------------------------------------------------------------
           #-----------------------------------------------------------------------------------
   
          Route::get('/inviting-users', 'Users\VendorsController@index2')->name('user.inviting.users'); 
          Route::get('/inviting-user', 'Users\VendorsController@add2')->name('users.invite.newUser'); 
          Route::post('/inviting-user', 'Users\VendorsController@store2')->name('users.invite.newUser');

          Route::get('event/{slug}/budget', 'Tools\BudgetController@index')->name('users.budget');

          Route::post('event/budget/base_price/ajax','Tools\BudgetController@ajax_editprice')->name('ajax_editprice');

          Route::any('event/budget/newcat/ajax','Tools\BudgetController@ajax_newcat')->name('ajax_newcat');

          Route::any('event/budget/bardata/ajax','Tools\BudgetController@graphData')->name('user.category.graphData');

          Route::post('event/budget/add_note/ajax','Tools\BudgetController@ajax_addnote')->name('ajax_addnote');

          Route::get('event/{slug}/budgetPayment', 'Tools\BudgetController@indexPayment')->name('users.eventPayment');

          Route::get('event/budget/subcategories', 'Tools\BudgetController@getBudgetCategory')->name('user.category.getBudgetCategory');

          Route::get('event/budget/categories', 'Tools\BudgetController@budgetCategory')->name('user.category.BudgetCategory');

           Route::get('event/budget/update/function', 'Tools\BudgetController@updateFunction')->name('user.category.updateFunction');
           Route::get('event/budget/remove/function', 'Tools\BudgetController@removeFunction')->name('user.subcategory.removeFunction');

           Route::get('event/{slug}/budget/print', 'Tools\BudgetController@printFunction')->name('user.budget.printFunction');
           Route::get('event/{slug}/budget/pdf', 'Tools\BudgetController@getPDFBudget')->name('user.budget.getPDFBudget');

           Route::get('event/{slug}/vendors', 'Tools\VendorController@index')->name('users.events.vendors');

           Route::get('event/{slug}/guestlist', 'Tools\GuestListController@index')->name('users.guestList');

           Route::get('event/guestlist/getgroups/ajax','Tools\GuestListController@ajax_getgroups')->name('user.event.getgroups');

           Route::get('event/guestlist/getmenus/ajax','Tools\GuestListController@ajax_getmenus')->name('user.event.getmenus');

           Route::get('event/guestlist/getattendance/ajax','Tools\GuestListController@ajax_getattendance')->name('user.event.getattendance');

           Route::get('event/guestlist/getstats/ajax','Tools\GuestListController@ajax_getstats')->name('user.event.getstats');

           Route::post('event/guestlist/add_group/ajax','Tools\GuestListController@ajax_addgroup')->name('ajax_addgroup');

           Route::post('event/guestlist/add_menu/ajax','Tools\GuestListController@ajax_addmenu')->name('ajax_addmenu');

           Route::post('event/guestlist/add_guest/ajax','Tools\GuestListController@ajax_addguest')->name('ajax_addguest');

           Route::get('event/guestlist/update_attendance_menu/ajax','Tools\GuestListController@ajax_updateAttMenu')->name('user.guest.ajax_updateAttMenu');

           Route::get('event/guestlist/remove_group_menu/ajax','Tools\GuestListController@ajax_removeGroupMenu')->name('user.ajax_removeGroupMenu');

           Route::get('event/{slug}/guestlist/print', 'Tools\GuestListController@printFunction')->name('user.guestlist.printFunction');

           Route::get('event/{slug}/guestlist/pdf', 'Tools\GuestListController@getPDFBudget')->name('user.guestlist.getPDFBudget');

           //Route::get('importExport', 'GuestListController@importExport');
           Route::get('event/{slug}/downloadExcel/{type}', 'Tools\GuestListController@downloadExcel')->name('user.guestlist.downloadformat');

           Route::post('event/importExcel', 'Tools\GuestListController@importExcel')->name('user.guestlist.importExcel');

           Route::get('/forum/create', 'Tools\ForumController@createDiscussion')->name('user.forum.create');
           Route::post('/forum/store', 'Tools\ForumController@storeDiscussion')->name('user.forum.store');

           Route::get('/forum/create/photo', 'Tools\ForumController@createPhoto')->name('forum.photo.create');
           Route::post('/forum/store/photo', 'Tools\ForumController@storePhoto')->name('forum.photo.store');

           Route::get('/forum/create/video', 'Tools\ForumController@createVideo')->name('forum.video.create');
           Route::post('/forum/store/video', 'Tools\ForumController@storeVideo')->name('forum.video.store');

           Route::post('/forum/comment/save', 'Tools\ForumController@storeComment')->name('forum.comment.store');
           Route::get('/forum/comment/edit/{id}', 'Tools\ForumController@editComment')->name('forum.comment.edit');
           Route::post('/forum/comment/update/{id}', 'Tools\ForumController@updateComment')->name('forum.comment.update');

           Route::get('/forum/group/{slug}/join', 'Tools\ForumController@groupJoin')->name('forum.group.join');
           Route::get('/forum/group/{slug}/leave', 'Tools\ForumController@groupLeave')->name('forum.group.leave');

           Route::any('/send_request', 'Tools\ForumController@sendRequest')->name('forum.send_request');
           Route::any('/cancel_request', 'Tools\ForumController@cancelRequest')->name('forum.cancel_request');
           Route::any('/remove_friend', 'Tools\ForumController@removeFriend')->name('forum.remove_friend');
           Route::any('/accept_friend', 'Tools\ForumController@acceptFriend')->name('forum.accept_friend');

           Route::post('/store_business_review', 'Users\BusinessReviewsController@store')->name('business.review.store');
           Route::post('/share_user_event', 'Users\UserEventController@shareEvent')->name('user.event.share');
            Route::post('/share_registration_event', 'Users\UserEventController@shareRegistrationEvent')->name('user.event.shareRegistration');
           Route::post('/post_user_testimonial', 'Users\UserEventController@postTestimonial')->name('user.testimonial.post');
           Route::post('/thank-you-note', 'Users\UserEventController@postThanksNote')->name('user.guest.thanks');

           Route::get('/review-form/{event_order_id}', 'Users\BusinessReviewsController@reviewForm')->name('review_form');
           Route::post('/review-sumbit', 'Users\BusinessReviewsController@reviewSubmit')->name('review_submit');

           Route::get('/events/{slug}/videos', 'Users\UserEventController@videos')->name('user.event.videos');
           Route::post('/events/{slug}/videos', 'Users\UserEventController@storeVideos')->name('user.event.post_videos');
           Route::get('/events/{slug}/{id}/video/delete', 'Users\UserEventController@videoDelete')->name('user.event.video.delete');

           Route::post('/store_business_dispute', 'Users\UserDisputeController@store')->name('business.dispute.store');

           Route::get('/dispute', 'Users\UserDisputeController@disputelist')->name('dispute');
           Route::get('/dispute/{id}', 'Users\UserDisputeController@detail')->name('user.disputeDetail');
           Route::post('/dispute/{id}', 'Users\UserDisputeController@create')->name('user.disputeDetail');
           Route::get('/dispute/raiseagain/{id}','Users\UserDisputeController@raiseAgain')->name('user.raiseAgain');


           Route::post('/event_cancel', 'Users\UserEventController@changeStatus')->name('user.event.eventcancel');

            Route::get('/events/{slug}/chat', 'Users\ReschedularController@index')->name('user.event.chat');

            Route::get('/tickets', 'Users\UserEventController@tickets')->name('tickets');
            Route::get('/edittickets/{id}', 'Users\UserEventController@edittickets')->name('edittickets');
            Route::post('/edittickets/{id}', 'Users\UserEventController@storetickets')->name('edittickets');
});