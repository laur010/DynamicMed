<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init_Database extends CI_Migration {

  public function up()
  {
    // ROLES TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `roles` (
                      `role_id` int(11) NOT NULL,
                      `name` varchar(20) NOT NULL
                      )
                      ");
    $this->db->query("
                      INSERT INTO `roles` (`role_id`, `name`) VALUES
                        (1, 'Admin');
                      ");
    $this->db->query("
                      ALTER TABLE `roles` ADD PRIMARY KEY (`role_id`);
                      ");
    $this->db->query("
                      ALTER TABLE `roles` MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    // DEPARTMENTS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `departments` (
                      `department_id` int(11) NOT NULL,
                      `name` varchar(20) NOT NULL,
                      `details` text NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `departments` ADD PRIMARY KEY (`department_id`);
                      ");
    $this->db->query("
                      ALTER TABLE `departments` MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    // SALONS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `salons` (
                      `salon_id` int(11) NOT NULL,
                      `name` varchar(20) NOT NULL,
                      `department_id` int(11) NOT NULL,
                      `capacity` int(11) NOT NULL,
                      `description` text NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `salons` ADD PRIMARY KEY (`salon_id`);
                      ");
    $this->db->query("
                      ALTER TABLE `salons` MODIFY `salon_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");
    $this->db->query("
                      ALTER TABLE `salons` ADD INDEX `department_id` (`department_id`);
                      ");

    // PATIENTS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `patients` (
                      `patient_id` int(11) NOT NULL,
                      `salon_id` int(11) NOT NULL,
                      `first_name` varchar(20) NOT NULL,
                      `last_name` varchar(20) NOT NULL,
                      `gender` tinyint(1) NOT NULL,
                      `cnp` varchar (40) NOT NULL,
                      `phone` varchar (40) NOT NULL,
                      `hospitalized` tinyint(1) NOT NULL,
                      `born_date` date NOT NULL,
                      `residence` varchar(255) NOT NULL,
                      `environment` tinyint(1) NOT NULL,
                      `born_weight` int(11) NOT NULL,
                      `nationality` int(11) NOT NULL,
                      `occupation` int(11) NOT NULL,
                      `job` varchar(255) NOT NULL,
                      `blood_type` int(4) NOT NULL,
                      `rh` tinyint(1) NOT NULL,
                      `allergic` varchar(255) NOT NULL,
                      `training_level` int(11) NOT NULL,
                      `insurance` int(11) NOT NULL,
                      `cnas_type_insurance` int(11) NOT NULL,
                      `cnas_category_insurance` int(11) NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `patients` ADD PRIMARY KEY (`patient_id`);
                      ");
    $this->db->query("
                      ALTER TABLE `patients` MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");
    $this->db->query("
                      ALTER TABLE `patients` ADD INDEX `salon_id` (`salon_id`);
                      ");

    // USERS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `users` (
                      `user_id` int(11) NOT NULL,
                      `first_name` varchar(40) DEFAULT NULL,
                      `last_name` varchar(40) DEFAULT NULL,
                      `phone` varchar(40) DEFAULT NULL,
                      `username` varchar(20) NOT NULL,
                      `password` varchar(40) NOT NULL,
                      `email` varchar(40) NOT NULL,
                      `role_id` int(11) NOT NULL,
                      `profile_image_id` int(11) NOT NULL DEFAULT 0,
                      `city` varchar(40) NOT NULL,
                      `address` varchar(250) NOT NULL,
                      `country` varchar(40) NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `users` ADD PRIMARY KEY (`user_id`),
                      ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");
    $this->db->query("
                      INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `phone`, `role_id`) VALUES
                        (1, 'Tilciu', 'Laurentiu', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'tilciu.laurentiu@yahoo.com', '0746462938', 1);
                        ");

    // PERMISSIONS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `permissions` (
                      `permission_id` int(11) NOT NULL,
                      `page` varchar(40) NOT NULL,
                      `function` varchar(20) NOT NULL,
                      `label` varchar(20) DEFAULT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `permissions` ADD PRIMARY KEY (`permission_id`);
                      ");
    $this->db->query("
                      ALTER TABLE `permissions` MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");
    $this->db->query("
                      INSERT INTO `permissions` (`permission_id`, `page`, `function`, `label`) VALUES
                        (1, 'dashboard', 'index', 'Grafice'),
                        (2, 'users', 'index', 'Lista Utilizatori'),
                        (3, 'users', 'add', 'Adaugare Utilizatori'),
                        (4, 'users', 'edit', 'Editare Utilizatori'),
                        (5, 'users', 'delete', 'Stergere Utilizatori'),
                        (6, 'users', 'details', 'Detalii Utilizatori'),
                        (7, 'users', 'process_request', 'Alte Functionalitati'),
                        (8, 'roles', 'index', 'Lista Roluri'),
                        (9, 'roles', 'add', 'Adaugare Roluri'),
                        (10, 'roles', 'edit', 'Editare Roluri'),
                        (11, 'roles', 'delete', 'Stergere Roluri'),
                        (12, 'roles', 'details', 'Detalii Roluri'),
                        (13, 'roles', 'process_request', 'Alte Functionalitati'),
                        (14, 'actions', 'index', 'Lista Actiuni'),
                        (15, 'actions', 'details', 'Detalii Actiuni'),
                        (16, 'actions', 'process_request', 'Alte Functionalitati'),
                        (17, 'profile', 'index', 'Profil'),
                        (18, 'profile', 'process_request', 'Alte Functionalitati'),
                        (19, 'departments', 'index', 'Lista Sectii'),
                        (20, 'departments', 'add', 'Adaugare Sectii'),
                        (21, 'departments', 'edit', 'Editare Sectii'),
                        (22, 'departments', 'delete', 'Stergere Sectii'),
                        (23, 'departments', 'details', 'Detalii Sectii'),
                        (24, 'departments', 'process_request', 'Alte Functionalitati'),
                        (25, 'patients', 'index', 'Lista Pacienti'),
                        (26, 'patients', 'add', 'Adaugare Pacienti'),
                        (27, 'patients', 'edit', 'Editare Pacienti'),
                        (28, 'patients', 'delete', 'Stergere Pacienti'),
                        (29, 'patients', 'details', 'Detalii Pacienti'),
                        (30, 'patients', 'process_request', 'Alte Functionalitati'),
                        (31, 'salons', 'index', 'Lista Saloane'),
                        (32, 'salons', 'add', 'Adaugare Saloane'),
                        (33, 'salons', 'edit', 'Editare Saloane'),
                        (34, 'salons', 'delete', 'Stergere Saloane'),
                        (35, 'salons', 'details', 'Detalii Saloane'),
                        (36, 'salons', 'process_request', 'Alte Functionalitati'),
                        (37, 'observation_records', 'index', 'Lista Foi de Observatie'),
                        (38, 'observation_records', 'add', 'Adaugare Foi de Observatie'),
                        (39, 'observation_records', 'edit', 'Editare Foi de Observatie'),
                        (40, 'observation_records', 'delete', 'Stergere Foi de Observatie'),
                        (41, 'observation_records', 'details', 'Detalii Foi de Observatie'),
                        (42, 'observation_records', 'process_request', 'Alte Functionalitati');
                        ");


    // ROLES_PERMISSIONS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `roles_permissions` (
                      `role_permission_id` int(11) NOT NULL,
                      `role_id` int(11) NOT NULL,
                      `permission_id` int(11) NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `roles_permissions` ADD PRIMARY KEY (`role_permission_id`),
                      ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                      ADD CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `roles_permissions` MODIFY `role_permission_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");
    $this->db->query("
                      INSERT INTO `roles_permissions` (`role_permission_id`, `role_id`, `permission_id`) VALUES
                        (1, 1, 1),
                        (2, 1, 2),
                        (3, 1, 3),
                        (4, 1, 4),
                        (5, 1, 5),
                        (6, 1, 6),
                        (7, 1, 7),
                        (8, 1, 8),
                        (9, 1, 9),
                        (10, 1, 10),
                        (11, 1, 11),
                        (12, 1, 12),
                        (13, 1, 13),
                        (14, 1, 14),
                        (15, 1, 15),
                        (16, 1, 16),
                        (17, 1, 17),
                        (18, 1, 18),
                        (19, 1, 19),
                        (20, 1, 20),
                        (21, 1, 21),
                        (22, 1, 22),
                        (23, 1, 23),
                        (24, 1, 24),
                        (25, 1, 25),
                        (26, 1, 26),
                        (27, 1, 27),
                        (28, 1, 28),
                        (29, 1, 29),
                        (30, 1, 30),
                        (31, 1, 31),
                        (32, 1, 32),
                        (33, 1, 33),
                        (34, 1, 34),
                        (35, 1, 35),
                        (36, 1, 36),
                        (37, 1, 37),
                        (38, 1, 38),
                        (39, 1, 39),
                        (40, 1, 40),
                        (41, 1, 41),
                        (42, 1, 42);
                        ");

    // ACTIONS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `actions` (
                      `action_id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `page` varchar(40) NOT NULL,
                      `function` varchar(40) NOT NULL,
                      `message` text NOT NULL,
                      `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `actions` ADD PRIMARY KEY (`action_id`),
                      ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `actions` MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    // NOTIFICATIONS TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `notifications` (
                      `notification_id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `message` text NOT NULL,
                      `active` tinyint(1) NOT NULL,
                      `class_type` tinyint(4) NOT NULL,
                      `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `notifications` ADD PRIMARY KEY (`notification_id`),
                      ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `notifications` MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    //USERS_IMAGES TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `profile_images` (
                      `profile_image_id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `name` varchar(255) NOT NULL,
                      `path` varchar(255) NOT NULL,
                      `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `profile_images` ADD PRIMARY KEY (`profile_image_id`),
                      ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `profile_images` MODIFY `profile_image_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");


    // OBSERVATION RECORDS
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `observation_records` (
                      `observation_record_id` int(11) NOT NULL,
                      `patient_id` int(11) NOT NULL,
                      `date_open` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `date_close` TIMESTAMP NOT NULL,
                      `hospitalized_type` int(11) NOT NULL,
                      `hospitalized_cause` int(11) NOT NULL,
                      `hospitalized_diagnostic` varchar(255) NOT NULL,
                      `reference_diagnostic` varchar(255) NOT NULL,
                      `discharge_diagnostic` varchar(255) NOT NULL,
                      `sec_discharge_diagnostic` varchar(255) NOT NULL,
                      `main_surgery` varchar(255) NOT NULL, -- data#|id1|id2|id3|#Interventie
                      `concurrent_surgery` varchar(255) NOT NULL, -- data#|id1|id2|id3|#Interventie
                      `other_surgery` varchar(255) NOT NULL, -- data#|id1|id2|id3|#Interventie
                      `discharge_status` int(11) NOT NULL, -- vindecat/ameliorat/stationar/agravat/decedat
                      `discharge_type` int(11) NOT NULL, -- externat/externat la cerere/ transfer interspitalicesc/ decedat
                      `death` int(11) NOT NULL, -- intraoperator/postoperator: 0 - 23 ore; 24-47; >48 ore;
                      `death_date` TIMESTAMP NOT NULL,
                      `diagnostic_death` varchar(255) NOT NULL,
                      `morphological_code` varchar(10) NOT NULL, -- in caz de cancer
                      `functional_explorations` varchar(255) NOT NULL, -- denumire,cod,nr json
                      `radiological_investigations` varchar(255) NOT NULL, -- denumire,cod,nr json
                      `therapeutic_procedures` varchar(255) NOT NULL, -- denumire,cod,nr json
                      `hospitalized_reason` varchar(255) NOT NULL,
                      `history` varchar(255) NOT NULL,
                      
                      `cytological_exam` text NOT NULL,
                      `extemporaneously_exam` text NOT NULL,
                      `histopathological_exam` text NOT NULL,
                      `general_exam` text NOT NULL, -- va fi un array
                      `oncology_exam` text NOT NULL,
                      `laboratory_exam` text NOT NULL, -- json - array('test' => 'test', 'rezultat' => 'rezultat')
                      `radiological_exam` text NOT NULL, -- text
                      `ultrasound_exam` text NOT NULL, -- text
                      `anatomopathological_exam` text NOT NULL,
                      `others_info` text NOT NULL, -- json (motivele, internarii, istoric_boala, anamneza, )
                      
                      `progress_diagnostic_sheet` text NOT NULL,
                      `temperature_sheet` text NOT NULL,
                      `discount_sheet` text NOT NULL
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `observation_records` ADD PRIMARY KEY (`observation_record_id`),
                      ADD FOREIGN KEY (`patient_id`) REFERENCES `patients`(`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `observation_records` MODIFY `observation_record_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    //RECORDS_IMAGES TABLE
    $this->db->query("
                      CREATE TABLE IF NOT EXISTS `observation_record_images` (
                      `observation_record_image_id` int(11) NOT NULL,
                      `observation_record_id` int(11) NOT NULL,
                      `type` varchar(255) NOT NULL, -- radiologic/ecografic
                      `name` varchar(255) NOT NULL,
                      `path` varchar(255) NOT NULL,
                      `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                      )
                      ");
    $this->db->query("
                      ALTER TABLE `observation_record_images` ADD PRIMARY KEY (`observation_record_image_id`),
                      ADD FOREIGN KEY (`observation_record_id`) REFERENCES `observation_records`(`observation_record_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                      ");
    $this->db->query("
                      ALTER TABLE `observation_records` MODIFY `observation_record_id` int(11) NOT NULL AUTO_INCREMENT;
                      ");

    echo "Finished version 1.\n";

  }

  public function down()
  {
    echo "Finished version 1.\n";
  }
}