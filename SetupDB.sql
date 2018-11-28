DROP SCHEMA IF EXISTS bbs;
CREATE SCHEMA bbs;

create table bbs.bbusers (
 email varchar(50),
 name varchar(30),
 password varchar(10),
 nickname varchar(30),
 primary key (email)
);
create table bbs.postings (
 postId integer(5) auto_increment,
 postDate datetime,
 postedBy varchar(50),
 postSubject varchar(100),
 content varchar(512),
 ancestorPath varchar(100),
 primary key (postId),
  foreign key (postedBy) references bbusers
); 
