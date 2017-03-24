  create table member (
  id    char(15) not null,
  pass  char(41) not null,
  fname  char(15) not null,
  lname  char(15) not null,
  email char(80) not null,
  regist_day char(20),
  level int,
  primary key(id)
  );