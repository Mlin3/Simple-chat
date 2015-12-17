
create table users (
    sessionID char(140) not null,
    userName char(40) not null UNIQUE,
    time int unsigned not null,

    primary key(sessionID),
    INDEX (time)
);

create table messages (
    messageID bigint unsigned not null auto_increment,
    userName char(40) not null,
    content text not null,
    time int unsigned not null,

    primary key(messageID),
    INDEX (time)
);
