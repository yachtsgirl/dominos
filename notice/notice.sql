create table notice (
   num int not null auto_increment,
   id char(15) not null,
   fname  char(15) not null,
   subject char(100) not null,
   content text not null,
   regist_day char(20),
   hit int,
   primary key(num)
);
