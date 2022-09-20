<?php
namespace App\Traits;
use App\Models\Admin\PageMetaTag;

trait GeneralSettingTrait {



 public $ignors = [
     '_token'
 ];


  public function getArrayValue($slug) {
	    switch ($slug) {
		 	case 'homepage':
		 		    return [
                       // Meta Data
                       'meta_title' => getAllValueWithMeta('meta_title', $slug),
                       'meta_description' => getAllValueWithMeta('meta_description', $slug),
                       'meta_keyword' => getAllValueWithMeta('meta_keyword', $slug),
		 		    	         
                       // Slider
                       'slider_title' => getAllValueWithMeta('slider_title', $slug),
                       'slider_tagline' => getAllValueWithMeta('slider_tagline', $slug),
                       'slider_video_url' => getAllValueWithMeta('slider_video_url', $slug),
                       'slider_button_title' => getAllValueWithMeta('slider_button_title', $slug),
                       'slider_button_url' => getAllValueWithMeta('slider_button_url', $slug),

						            // Section 1 
                       'section1_title' => getAllValueWithMeta('section1_title', $slug),
                       'section1_tagline' => getAllValueWithMeta('section1_tagline', $slug),

                       // Section 2
                       'section2_title' => getAllValueWithMeta('section2_title', $slug),
                       'section2_tagline' => getAllValueWithMeta('section2_tagline', $slug),
                       'section2_image' => getAllValueWithMeta('section2_image', $slug),
                       'section2_image_tagline' => getAllValueWithMeta('section2_image_tagline', $slug),

                       // Section 3
                       'section3_title' => getAllValueWithMeta('section3_title', $slug),
                       'section3_tagline' => getAllValueWithMeta('section3_tagline', $slug),
                       'section3_video' => getAllValueWithMeta('section3_video', $slug),
                       'section3_video_poster' => getAllValueWithMeta('section3_video_poster', $slug),

                       // Section 4
                       'section4_title1' => getAllValueWithMeta('section4_title1', $slug),
                       'section4_tagline1' => getAllValueWithMeta('section4_tagline1', $slug),
                       'section4_description' => getAllValueWithMeta('section4_description', $slug),
                       'section4_title2' => getAllValueWithMeta('section4_title2', $slug),
                       'section4_tagline2' => getAllValueWithMeta('section4_tagline2', $slug),
                       'section4_image' => getAllValueWithMeta('section4_image', $slug),
                       'section4_button_title' => getAllValueWithMeta('section4_button_title', $slug),
                       'section4_button_url' => getAllValueWithMeta('section4_button_url', $slug),

                       // Section 5
                       'section5_title' => getAllValueWithMeta('section5_title', $slug),
		 		    ];
		 		break;
        case 'budget-tool':
            return [
                      'budget_title' => getAllValueWithMeta('budget_title', $slug),
                      'budget_tagline' => getAllValueWithMeta('budget_tagline', $slug),
                      'video_title' => getAllValueWithMeta('video_title', $slug),
                       'video_video' => getAllValueWithMeta('video_video', $slug),
                      'video_video_poster' => getAllValueWithMeta('video_video_poster', $slug),

                       
            ];
        break;
      case 'checklist-tool':
            return [
                      'checklist_title' => getAllValueWithMeta('checklist_title', $slug),
                      'checklist_tagline' => getAllValueWithMeta('checklist_tagline', $slug),
                      'checklist_video_title' => getAllValueWithMeta('checklist_video_title', $slug),
                       'checklist_video' => getAllValueWithMeta('checklist_video', $slug),
                      'checklist_video_poster' => getAllValueWithMeta('checklist_video_poster', $slug),

                       
            ];
        break;
        case 'vendor-tool':
            return [
                      'vendor_title' => getAllValueWithMeta('vendor_title', $slug),
                      'vendor_tagline' => getAllValueWithMeta('vendor_tagline', $slug),
                      'vendor_video_title' => getAllValueWithMeta('vendor_video_title', $slug),
                       'vendor_video' => getAllValueWithMeta('vendor_video', $slug),
                      'vendor_video_poster' => getAllValueWithMeta('vendor_video_poster', $slug),

                       
            ];
        break;
        case 'guest-tool':
            return [
                      'guest_list_title' => getAllValueWithMeta('guest_list_title', $slug),
                      'guest_list_tagline' => getAllValueWithMeta('guest_list_tagline', $slug),
                      'guest_list_video_title' => getAllValueWithMeta('guest_list_video_title', $slug),
                       'guest_list_video' => getAllValueWithMeta('guest_list_video', $slug),
                      'guest_list_video_poster' => getAllValueWithMeta('guest_list_video_poster', $slug),

                       
            ];
        break;
		 	case 'login':
		 		    return [
                      // Meta Data
                       'meta_title' => getAllValueWithMeta('meta_title', $slug),
                       'meta_description' => getAllValueWithMeta('meta_description', $slug),
                       'meta_keyword' => getAllValueWithMeta('meta_keyword', $slug),

                       'login_title' => getAllValueWithMeta('login_title', $slug),
                       'heading' => getAllValueWithMeta('heading', $slug),
                       'login_banner' => getAllValueWithMeta('login_banner', $slug),
                       'description' => getAllValueWithMeta('description', $slug),
                       
                       // Section 1
                       'section1_title' => getAllValueWithMeta('section1_title', $slug),
                       'section1_tagline' => getAllValueWithMeta('section1_tagline', $slug),
                       'section1_video' => getAllValueWithMeta('section1_video', $slug),
                       'section1_video_poster' => getAllValueWithMeta('section1_video_poster', $slug),
                       
                       // Section 2
                       'section2_title' => getAllValueWithMeta('section2_title', $slug),
		 		    ];
		 		break;
		 	case 'signup': 
		 	  	return [
                        // Meta Data
                       'meta_title' => getAllValueWithMeta('meta_title', $slug),
                       'meta_description' => getAllValueWithMeta('meta_description', $slug),
                       'meta_keyword' => getAllValueWithMeta('meta_keyword', $slug),

                       'signup_title' => getAllValueWithMeta('signup_title', $slug),
					             'signup_background_image' => getAllValueWithMeta('signup_background_image', $slug),
                       'heading' => getAllValueWithMeta('heading', $slug),
                       'signup_banner' => getAllValueWithMeta('signup_banner', $slug),
                       'description' => getAllValueWithMeta('description', $slug),
                       
                       // Section 1
                       'section1_title' => getAllValueWithMeta('section1_title', $slug),
                       'section1_tagline' => getAllValueWithMeta('section1_tagline', $slug),
                       'section1_video' => getAllValueWithMeta('section1_video', $slug),
                       'section1_video_poster' => getAllValueWithMeta('section1_video_poster', $slug),
                       
                       // Section 2
                       'section2_title' => getAllValueWithMeta('section2_title', $slug),
		 	  	];
		 	case 'vendor-signup': 
		 	  	return [
                        // Meta Data
                       'meta_title' => getAllValueWithMeta('meta_title', $slug),
                       'meta_description' => getAllValueWithMeta('meta_description', $slug),
                       'meta_keyword' => getAllValueWithMeta('meta_keyword', $slug),
                       
          					   'signup_title' => getAllValueWithMeta('signup_title', $slug),
                       'signup_background_image' => getAllValueWithMeta('signup_background_image', $slug),
                       'heading' => getAllValueWithMeta('heading', $slug),
                       'signup_banner' => getAllValueWithMeta('signup_banner', $slug),
                       'description' => getAllValueWithMeta('description', $slug),
                       
                       // section 1
                       'section1_title' => getAllValueWithMeta('section1_title', $slug),
                       'section1_tagline' => getAllValueWithMeta('section1_tagline', $slug),
                       'section1_video' => getAllValueWithMeta('section1_video', $slug),
                       'section1_video_poster' => getAllValueWithMeta('section1_video_poster', $slug),
                       
                       // Section 2
                       'section2_title' => getAllValueWithMeta('section2_title', $slug),
		 	  	];
		 	case 'global-settings': 
          return [
                  'gallery_expiration_time' => getAllValueWithMeta('gallery_expiration_time', $slug),
                  'admin_escrow_percentage' => getAllValueWithMeta('admin_escrow_percentage', $slug),
                  'google_api_key' => getAllValueWithMeta('google_api_key', $slug),
                  'weather_api_key' => getAllValueWithMeta('weather_api_key', $slug),
                  'taxjar_api_key' => getAllValueWithMeta('taxjar_api_key', $slug),
                  'commission_fee_type' => getAllValueWithMeta('commission_fee_type', $slug),
                  'commission_fee_amount' => getAllValueWithMeta('commission_fee_amount', $slug),
                  'service_fee_type' => getAllValueWithMeta('service_fee_type', $slug),
                  'service_fee_amount' => getAllValueWithMeta('service_fee_amount', $slug),
                  'contact_email' => getAllValueWithMeta('contact_email', $slug),
                  'alter_email' => getAllValueWithMeta('alter_email', $slug),
                  'address' => getAllValueWithMeta('address', $slug),
                  'phone_number' => getAllValueWithMeta('phone_number', $slug),
                  'mobile' => getAllValueWithMeta('mobile', $slug),
                  'facebook_url' => getAllValueWithMeta('facebook_url', $slug),
                  'email_id' => getAllValueWithMeta('email_id', $slug),
                  'twitter_url' => getAllValueWithMeta('twitter_url', $slug),
                  'instagram_url' => getAllValueWithMeta('instagram_url', $slug),
                  'linkedin_url' => getAllValueWithMeta('linkedin_url', $slug),
                  'skype' => getAllValueWithMeta('skype', $slug),
                  'whatsapp_num' => getAllValueWithMeta('whatsapp_num', $slug),

          ];
      case 'paypal-credentials': 
          return [
                  'paypal_credentials' => getAllValueWithMeta('paypal_credentials', $slug)
          ];
      case 'stripe-credentials':
          return [
                  'stripe_credentials' => getAllValueWithMeta('stripe_credentials', $slug),
          ];
		 	default:
		 		# code...
		 		break;
		 }	 
		 
 }




     
}




















