INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `spanish`, `portuguese`, `hindi`, `french`, `serbian`, `arabic`) VALUES
(NULL, 'venues_and_conferences', 'Venues & Conferences', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'venues', 'Venues', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'conferences', 'Conferences', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'telephone', 'Telephone', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'direction', 'Direction', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'venue', 'Venue', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'conference', 'Conference', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'conference_name', 'Conference Name', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'cancel', 'Cancel', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'longitude', 'Longitude', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'latitude', 'Latitude', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'successfully_update', 'Successfully updated', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'successfully_delete', 'Successfully deleted', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'failed_delete', 'Failed to delete', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'venue_cannot_be_deleted_because_it_is_already_in_use_in_conference', 'Venue cannot be deleted because it is already in use in conference', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'duplicate', 'Duplicate', '', NULL, NULL, NULL, NULL, ''),
(NULL, 'duplicate_subject', 'Duplicate Subject', '', NULL, NULL, NULL, NULL, '');

ALTER TABLE `nota_capacidad` CHANGE `reason` `reason` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `student_subject` CHANGE `reason` `reason` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;