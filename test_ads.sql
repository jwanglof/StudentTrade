START TRANSACTION;
USE `db1162056_st`;
INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(1, 'Test1', 'Test1',  1234, 1, '2013-09-18 07:00:00', '2013-09-19 07:00:00', 0, 1, 1, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(2, 'Test2', 'Test2',  1234, 2, '2013-09-19 07:00:00', '2013-09-19 07:00:00', 0, 2, 6, 3, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(3, 'Test3', 'Test3',  1234, 3, '2013-09-11 07:00:00', '2013-09-19 07:00:00', 0, 3, 9, 3, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(4, 'Test4', 'Test4',  1234, 4, '2013-09-12 07:00:00', '2013-09-19 07:00:00', 0, 4, 5, 2, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(5, 'Test5', 'Test5',  1234, 5, '2013-09-15 07:00:00', '2013-09-19 07:00:00', 0, 5, 3, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(6, 'Test6', 'Test6',  1234, 6, '2013-09-01 07:00:00', '2013-09-19 07:00:00', 0, 6, 3, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(7, 'Test7', 'Test7',  1234, 7, '2013-09-04 07:00:00', '2013-09-19 07:00:00', 0, 1, 2, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(8, 'Test8', 'Test8',  1234, 8, '2013-09-22 07:00:00', '2013-09-19 07:00:00', 0, 2, 2, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(9, 'Test9', 'Test9',  1234, 9, '2013-09-23 07:00:00', '2013-09-19 07:00:00', 0, 3, 7, 3, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(10, 'Test10', 'Test10',  1234, 10, '2013-09-00 07:00:00', '2013-09-19 07:00:00', 0, 4, 7, 3, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(11, 'Test11', 'Test11',  1234, 11, '2013-09-03 07:00:00', '2013-09-19 07:00:00', 0, 5, 1, 1, 1);

INSERT INTO `db1162056_st`.`ad` 
		(`id`, `title`, `info`, `password`, `price`, `date_created`, `date_expired`, `showed`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
		VALUES 
		(12, 'Test12', 'Test12',  1234, 12, '2013-09-08 07:00:00', '2013-09-19 07:00:00', 0, 6, 5, 2, 1);

COMMIT;