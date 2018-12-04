DROP SCHEMA IF EXISTS bbs;
CREATE SCHEMA bbs;

create table bbs.bbusers (
 user_id integer(10) NOT NULL AUTO_INCREMENT,
 email varchar(50) UNIQUE,
 name varchar(30),
 password varchar(10),
 nickname varchar(30),
 primary key (user_id)
) ENGINE=InnoDB;

create table bbs.postings (
 message_id 	integer(10) NOT NULL AUTO_INCREMENT,
 poster_id 		integer(10) NOT NULL,
 postedBy 		varchar(50) NOT NULL,
 subject 		varchar(100),
 content 		varchar(512) NOT NULL,
 date 			timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 parent_id		int(10) NOT NULL,	-- references the poster_id / ancestor
 primary key (message_id),
 foreign key (poster_id) references bbusers(user_id) ON UPDATE CASCADE 
) ENGINE=InnoDB; 

