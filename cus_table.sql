CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(255)  DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '2',
  `is_active` smallint(6) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255)  DEFAULT NULL,
  `mobile_number` varchar(255)  DEFAULT NULL,
  `profile_picture` varchar(255)  DEFAULT NULL,
   `location_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100)  DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(255)  NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255)  DEFAULT NULL,
  `image` varchar(255)  DEFAULT NULL,
  `is_active` smallint(6) NOT NULL DEFAULT '1',
  `is_blog` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `login_details` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `device_ip` varchar(255)  DEFAULT NULL,
  `details` varchar(255)  DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED  NULL,
  `postal_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `attribute_master` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `attribute_name` varchar(255)  NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `attribute_detail` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `attribute_id` bigint(20) UNSIGNED  NULL,
  `attribute_value` varchar(255)  NOT NULL,
   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
    FOREIGN KEY (attribute_id)
        REFERENCES attribute_master(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE VIEW `category_view`  AS  select `a`.`id` AS `id`,`a`.`category_name` AS `category_name`,`b`.`category_name` AS `parent`,`a`.`image` AS `image`,`a`.`is_active` AS `is_active`,,`a`.`is_blog` AS `is_blog` from (`categories` `a` left join `categories` `b` on((`a`.`parent_id` = `b`.`id`))) ;

CREATE VIEW `location_view`  AS  select `a`.`id` AS `id`,`a`.`location_name` AS `location_name`,`b`.`location_name` AS `parent`,`a`.`postal_code` AS `postal_code` from (`locations` `a` left join `locations` `b` on((`a`.`parent_id` = `b`.`id`))) ;

