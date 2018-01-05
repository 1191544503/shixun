
create table file(
 id int AUTO_INCREMENT PRIMARY key NOT NULL,
 filename char(100),
 filetype char(100),
 filesavename char(150),
 fileusername char(50),
 filesavefolder char(30),
 filelabel char(30),
 isdelete int,
 count int,
 upfile_time date
)charset utf8 collate utf8_general_ci;
create table user(
  id int AUTO_INCREMENT PRIMARY key NOT NULL,
	username char(20) not null,
	password char(100) not null,
	email char(100) not null,
	isdelete int
);
create table admin(
  id int AUTO_INCREMENT PRIMARY key NOT NULL,
	username char(20) not null,
	password char(100) not null,
	levels int(11)
);
create table jubao(
  id int AUTO_INCREMENT PRIMARY key NOT NULL,
  filesavename char(100),
  count int,
  isdelete int
);