RENAME TABLE `venues` TO `branch`;
ALTER TABLE `branch` CHANGE `venues_id` `branch_id` INT;
RENAME TABLE `conferences` TO `shifts`;
ALTER TABLE `shifts` CHANGE `conferences_id` `shifts_id` INT;
ALTER TABLE `shifts` CHANGE `venues_id` `branch_id` INT;

ALTER TABLE `branch`
MODIFY `branch_id` INT AUTO_INCREMENT;

ALTER TABLE `shifts`
MODIFY `shifts_id` INT AUTO_INCREMENT;
