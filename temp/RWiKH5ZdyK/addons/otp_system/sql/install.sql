SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `sms_templates` (
  `id` int(11) NOT NULL,
  `identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sms_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `sms_templates` (`id`, `identifier`, `sms_body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mobile_number_verification', '<p>[[code]] is your verification code for [[site_name]].\r\n</p><p>\r\n[[url]]</p>', 1, '2021-03-01 08:04:26', '2021-03-14 05:09:44'),
(2, 'account_opening_by_admin', '<p>Congratulations [[name]]!\r\n</p><p>You have been added to&nbsp;[[site_name]] as a member.\r\n</p><p>Password is : [[password]]\r\n</p><p>Please contact the&nbsp;administration&nbsp;team if you have any further questions. Best wishes.\r\n</p><p>[[url]]</p>', 0, '2021-03-01 08:17:01', '2021-04-10 06:54:47'),
(3, 'account_approval', '<p>Congratulations [[name]]!\r\n</p><p>Your account has been approved for [[sitename]] </p><p>Please contact the administration team if you have any further questions. Best wishes.\r\n</p><p>[[url]]</p>', 0, '2021-03-01 08:24:17', '2021-03-18 03:29:48'),
(4, 'staff_account_opening', '<p>Congratulations [[name]],\r\n</p><p>You have been added to&nbsp;[[site_name]] as Staff.\r\n</p><p>Your account role is : [[role_type]]</p><p>Password is : [[password]]\r\n</p><p>Please contact the&nbsp;administration&nbsp;team if you have any further questions. Best wishes.\r\n</p><p> [[url]]</p>', 0, '2021-03-01 08:56:25', '2021-04-10 06:54:52'),
(5, 'manual_payment_approval', '<p>Hi [[name]],\r\n</p><p>Your payment for the package purchase has been accepted. </p><p>Payment Code is [[payment_code]\r\n</p><p>[[url]]</p>', 0, '2021-03-01 08:59:42', '2021-04-10 06:54:56'),
(6, 'express_interest', '<p>Hi [[name]], </p><p>\r\n[[member_name]] has expressed interest in you.\r\n</p><p>[[url]]</p>', 0, '2021-03-01 09:07:49', '2021-04-10 06:54:59'),
(7, 'accept_interest', '<p>Hi [[name]], </p><p>\r\n[[member_name]] has accepted your interest. </p><p>\r\n[[url]]</p>', 0, '2021-03-01 09:08:13', '2021-04-10 06:55:03'),
(8, 'password_reset', '<p>Hi [[name]], </p><p>\r\nYour password reset code is [[code]]\r\n</p><p>[[url]]</p>', 1, '2021-03-01 09:42:45', '2021-03-18 02:43:42');


ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sms_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`, `deleted_at`)
VALUES
(NULL, 'twillo_activation', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(NULL, 'fast2sms_activation', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(NULL, 'mimo_activation', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(NULL, 'ssl_wireless_activation', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(NULL, 'nexmo_activation', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

COMMIT;
