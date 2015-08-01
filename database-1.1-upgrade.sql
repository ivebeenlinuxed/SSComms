ALTER TABLE equipment_checkout ADD COLUMN in_actor INT NULL;
ALTER TABLE equipment_checkout ADD FOREIGN KEY (`in_actor`) REFERENCES `person` (`id`);

ALTER TABLE equipment_checkout ADD COLUMN out_actor INT NULL;
ALTER TABLE equipment_checkout ADD FOREIGN KEY (`out_actor`) REFERENCES `person` (`id`);

-- Add Venue
CREATE TABLE IF NOT EXISTS `venue` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL DEFAULT 'Unnamed Venue'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Add venue_check
CREATE TABLE venue_check (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	venue int,
	time_completed int,
	actor int,
	status INT DEFAULT 0
);
ALTER TABLE venue_check ADD FOREIGN KEY
(`venue`) REFERENCES venue (`id`);
ALTER TABLE venue_check ADD FOREIGN KEY
(`actor`) REFERENCES person (`id`);

-- Add venue check question
CREATE TABLE `venue_check_question` (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	question varchar(255),
	status int NOT NULL DEFAULT 0
);

CREATE TABLE `venue_check_selected_question` (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	venue INT NOT NULL,
	venue_check_question INT NOT NULL
);
ALTER TABLE venue_check_selected_question
ADD FOREIGN KEY (`venue`) REFERENCES venue(`id`);
ALTER TABLE venue_check_selected_question
ADD FOREIGN KEY (`venue_check_question`)
REFERENCES venue_check_question(`id`);


-- Add venue_check_response
CREATE TABLE venue_check_response (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	venue_check INT NOT NULL,
	venue_check_question INT NOT NULL,
	response INT NOT NULL
);

ALTER TABLE venue_check_response ADD FOREIGN KEY
(`venue_check_question`) REFERENCES venue_check_question (`id`);

ALTER TABLE venue_check_response ADD FOREIGN KEY
(`venue_check`) REFERENCES venue_check (`id`);

