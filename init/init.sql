/* TODO: create tables */

CREATE TABLE `timeline`
(
	event_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	event_year INTEGER NOT NULL,
	event_month INTEGER NOT NULL,
	event_title TEXT NOT NULL
);

CREATE TABLE `photo_gallery`
(
photo_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
file_name TEXT NOT NULL,
file_ext TEXT NOT NULL,
photo_name TEXT NOT NULL,
photographer TEXT NOT NULL,
account_username TEXT
);

CREATE TABLE `tags`
(
tag_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
tag_name TEXT NOT NULL UNIQUE
);

CREATE TABLE `photos_in_tags`
(
id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
photo_id INTEGER NOT NULL,
tag_id INTEGER NOT NULL
);

CREATE TABLE `accounts` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`username`	TEXT NOT NULL UNIQUE,
	`password`	TEXT NOT NULL,
	`session`	TEXT UNIQUE
);

CREATE TABLE `comments` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`first_name` TEXT NOT NULL,
	`last_name` TEXT NOT NULL,
	`email` TEXT NOT NULL,
	`type` TEXT NOT NULL,
	`comment` TEXT NOT NULL
);


/* TODO: initial seed data */
INSERT INTO `accounts` (username,password) VALUES ("anthony_verghese","$2y$10$JyQefK9hxUIbmKSWiAwZNOYWiL.F2r67J621tixLRg5k5mqRKsDs6");/*coolCat*/
INSERT INTO `accounts` (username,password) VALUES ("mathew_verghese","$2y$10$FtiL6rko3Jl6X8OblnGl1ek9UBpm3gApFmX.j4odWOmdAtoQprFn6");/*lameCat*/

INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_1.jpg", "jpg", "First Annual Gala Photo 1","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_2.jpg", "jpg", "First Annual Gala Photo 2","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_3.JPG", "jpg", "First Annual Gala Photo 3","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_4.jpg", "jpg", "First Annual Gala Photo 4","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_5.jpg", "jpg", "First Annual Gala Photo 5","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_6.jpg", "jpg", "First Annual Gala Photo 6","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_7.jpg", "jpg", "First Annual Gala Photo 7","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("first_annual_gala_8.jpg", "jpg", "First Annual Gala Photo 8","John Ham");

INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_1.jpg", "jpg", "Second Annual Gala Photo 1","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_2.jpg", "jpg", "Second Annual Gala Photo 2","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_3.jpg", "jpg", "Second Annual Gala Photo 3","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_4.jpg", "jpg", "Second Annual Gala Photo 4","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_5.jpg", "jpg", "Second Annual Gala Photo 5","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_6.jpg", "jpg", "Second Annual Gala Photo 6","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_7.jpg", "jpg", "Second Annual Gala Photo 7","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("second_annual_gala_8.jpg", "jpg", "Second Annual Gala Photo 8","John Ham");

INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_1.jpg", "jpg", "Hunger Awareness Week Photo 1","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_2.jpg", "jpg", "Hunger Awareness Week Photo 2","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_3.JPG", "jpg", "Hunger Awareness Week Photo 3","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_4.jpg", "jpg", "Hunger Awareness Week Photo 4","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_5.jpg", "jpg", "Hunger Awareness Week Photo 5","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_6.jpg", "jpg", "Hunger Awareness Week Photo 6","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_7.jpg", "jpg", "Hunger Awareness Week Photo 7","John Ham");
INSERT INTO `photo_gallery` (file_name,file_ext,photo_name,photographer) VALUES ("hunger_awareness_week_8.jpg", "jpg", "Hunger Awareness Week Photo 8","John Ham");

INSERT INTO `tags` (tag_id,tag_name) VALUES (1,"First annual gala");
INSERT INTO `tags` (tag_id,tag_name) VALUES (2,"Second annual gala");
INSERT INTO `tags` (tag_id,tag_name) VALUES (3,"Hunger awareness week");

INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (1,1,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (2,2,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (3,3,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (4,4,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (5,5,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (6,6,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (7,7,1);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (8,8,1);

INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (9,9,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (10,10,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (11,11,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (12,12,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (13,13,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (14,14,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (15,15,2);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (16,16,2);


INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (17,17,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (18,18,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (19,19,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (20,20,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (21,21,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (22,22,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (23,23,3);
INSERT INTO `photos_in_tags` (id,photo_id,tag_id) VALUES (24,24,3);



INSERT INTO 'comments' (first_name,last_name,email,type,comment) VALUES ("Dan", "Madrid", "dem283@cornell.edu", "student", "Test");
INSERT INTO 'comments' (first_name,last_name,email,type,comment) VALUES ("Dan", "Madrid", "dem283@cornell.edu", "student", "I like the website.");
INSERT INTO 'comments' (first_name,last_name,email,type,comment) VALUES ("Anthony", "Verghese", "akv26@cornell.edu", "student", "Hi.");

INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2015, 8, "CAMP created");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2015, 8, "Partnership with Action Against Hunger Foundation");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2015, 11, "First Annual Hunger Awareness Week ");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2015, 11, "Participation in Big Red Dance-athon");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2016, 4, "Invitation to the Action Against Hunger Headquarters in NYC");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2016, 4, "First Annual Action Against Hunger Benefit Gala");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2016, 9, "Participation in Cornell Upward Bound Academy ");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2016, 11, "Second Annual Hunger Awareness Week ");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2017, 4, "Second Annual Action Against Hunger Benefit Gala");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2017, 8, "Introduction of Monthly Philanthropy Project");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2017, 9, "Philanthropy Event: Childhood Cancer Awareness");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2017, 10, "Philanthropy Event: Red Ribbon Week Against Drugs");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2017, 11, "Third Annual Hunger Awareness Week");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2018, 2, "Philanthropy Event: American Heart Month");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2018, 3, "Philanthropy Event: Sleep Awareness");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2018, 4, "Philanthropy Event: Sexual Assault Awareness");
INSERT INTO 'timeline' (event_year, event_month, event_title) VALUES (2018, 4, "Third Annual Action Against Hunger Benefit Gala");
