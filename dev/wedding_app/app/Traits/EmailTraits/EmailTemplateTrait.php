<?php
namespace App\Traits\EmailTraits;
use Illuminate\Http\Request;
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\Order;
use App\Models\EventOrder;
use Session;

trait EmailTemplateTrait {


protected $emailTemplate = [
      'UserOrderSuccessFullNotification' => 4,
      'AdminOrderSuccessFullNotification' => 5,
      'VendorOrderSuccessFullNotification' => 6,
      'VendorApprovalNotificationFullNotification' => 7,
      'VendorRejectionNotificationFullNotification' => 8,
      'VendorInvitingRequestNotificationFullNotification' => 9,
      'NewVendorEmailNotificationFullNotification' => 10,
      'NewVendorEmailJoinNotificationFullNotification' => 11,
      'PricingRequestEmailNotificationFullNotification' => 12,
      'CustomPackageRequestEmailNotificationFullNotification' => 13,
      //shop
      'ShopOrderPlacedNotification' => 14,
      'ShopOrderPlacedVendorNotification' => 15,
      'BlockVendorEmailFullNotification' => 16,
      'UserInvitingRequestNotificationFullNotification' => 17,
      'ShopRejectedEmailTraitFullNotification' => 18,
      'productRejectedEmailTraitFullNotification' => 19,
      'ShopApprovedEmailTraitFullNotification' => 20,
      'ProductApprovedEmailTraitFullNotification' => 21,
      'UserEventGuestNotification' => 23,
      'ShareUserEventNotification' => 24,
      'GuestThankYouNoteNotification' => 25,
      'PendingReviewNotification' => 26,
      'EventInformationSharingNotification' => 27,
      'UserEventCoHostNotification' => 28,
      'FeedbackNotification' => 29,
      'BugNotification' => 30,
      'RequestFeatureNotification' => 31,
      'SubAdminRegistrationNotification' => 32,
      'SignupCouponCodeNotification' =>33,
      'ContactNotification' =>34,
      'UserDisputeNotification' =>35,
      'UserDisputeAdminNotification' =>36,
      'AdminInvolvedInDisputeNotification' =>37,
      'AgreedMailToAdminNotification' =>38,
      'RescheduleEmailToVendorNotification' =>39,
      'VendorAgreedForRescheduleNotification' =>40,
      'UserReschduleDatesNotification' =>41,
      'UserCancelTheEventNotification' =>42,
      'VirtualEventNotification' =>43,
      'HybridEventNotification' =>44,
      'RegistrationEventInvitationNotification' =>45,
      'UserRegistrationEventTraitNotification' =>46,
      'NegotiationDiscountEmailTraitNotification' =>48

];


public $adminEmail = 'patrickphp2@gmail.com';

}

