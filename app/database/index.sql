DROP TABLE login;

DROP TABLE cart;

DROP TABLE wishlist;

DROP TABLE orderes;

DROP TABLE location;

DROP TABLE governorate;

DROP TABLE item;

DROP TABLE products;

DROP TABLE register;

CREATE TABLE
    register (
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        NAME VARCHAR(32) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(32) NOT NULL,
        kind INT DEFAULT 0,
        activecode VARCHAR(255) NOT NULL,
        urlcode VARCHAR(255) NOT NULL,
        active INT DEFAULT 0,
        created TIMESTAMP DEFAULT now(),
        updated TIMESTAMP DEFAULT now()
    );

CREATE TABLE
    login(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        USER VARCHAR(255) NOT NULL,
        ip VARCHAR(20) NOT NULL,
        failed INT NOT NULL DEFAULT 0,
        BLOCK BOOLEAN DEFAULT FALSE,
        active text DEFAULT (md5(now() + (rand()) * 99)),
        date_block TIMESTAMP DEFAULT now(),
        DATE TIMESTAMP DEFAULT now(),
        foreign key (USER) references register(id)
    );

CREATE TABLE
    products(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        ar VARCHAR(255) NOT NULL,
        en VARCHAR(255) NOT NULL,
        updated TIMESTAMP DEFAULT now()
    );

CREATE TABLE
    item(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        products VARCHAR(255) NOT NULL,
        NAME text NOT NULL,
        info text NOT NULL,
        price DECIMAL NOT NULL,
        COUNT INT NOT NULL,
        descount INT DEFAULT 0,
        rating DECIMAL DEFAULT 0,
        added TIMESTAMP DEFAULT now(),
        updated TIMESTAMP DEFAULT now(),
        foreign key (products) references products (id)
    );

CREATE TABLE
    wishlist (
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        item VARCHAR(255) NOT NULL,
        USER VARCHAR(255) NOT NULL,
        added TIMESTAMP DEFAULT now(),
        foreign key (item) references item (id),
        foreign key (USER) references register (id)
    );

CREATE TABLE
    cart(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        item VARCHAR(255) NOT NULL,
        USER VARCHAR(255) NOT NULL,
        added TIMESTAMP DEFAULT now(),
        foreign key (item) references item (id),
        foreign key (USER) references register (id)
    );

CREATE TABLE
    governorate(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        NAME VARCHAR(255) NOT NULL,
        shopping DECIMAL NOT NULL,
        updated TIMESTAMP DEFAULT now()
    );

CREATE TABLE
    location(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        USER VARCHAR(255) NOT NULL,
        NAME VARCHAR(255) NOT NULL,
        governorate VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        street_name VARCHAR(255) NOT NULL,
        mobile VARCHAR(20) NOT NULL,
        foreign key (USER) references register (id),
        foreign key (governorate) references governorate(id)
    );

CREATE TABLE
    orderes(
        id VARCHAR(255) DEFAULT (md5(now() + (rand()) * 99)) primary key,
        item VARCHAR(255) NOT NULL,
        USER VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        added TIMESTAMP DEFAULT now(),
        foreign key (item) references item (id),
        foreign key (USER) references register (id),
        foreign key (location) references location (id)
    );

/*
 ? INSERT INTO login (USER, ip, date_block) 
 VALUES ('1d424c32560a8e806c9d12ca2b54fb46', "122.222.222", date_add(now(), INTERVAL 1 HOUR));
 
 */
INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali1",
        "ahmedali1@gmail.com",
        "ahmedali1",
        sha1("ahmedali1"),
        sha1(md5("ahmedali1"))
    );

INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali2",
        "ahmedali2@gmail.com",
        "ahmedali2",
        sha1("ahmedali2"),
        sha1(md5("ahmedali2"))
    );

INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali2",
        "ahmedali2@gmail.com",
        "ahmedali2",
        sha1("ahmedali2"),
        sha1(md5("ahmedali2"))
    );

INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali2",
        "ahmedali2@gmail.com",
        "ahmedali2",
        sha1("ahmedali2"),
        sha1(md5("ahmedali2"))
    );

INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali2",
        "ahmedali2@gmail.com",
        "ahmedali2",
        sha1("ahmedali2"),
        sha1(md5("ahmedali2"))
    );

INSERT INTO
    register(NAME, email, password, activecode, urlcode)
VALUES (
        "ahmedali2",
        "ahmedali2@gmail.com",
        "ahmedali2",
        sha1("ahmedali2"),
        sha1(md5("ahmedali2"))
    );

SELECT *
FROM register;