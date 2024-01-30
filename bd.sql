create table category
(
    categoryid   serial
        primary key,
    categoryname varchar(50) not null
        unique
);

create table content
(
    "contentID"        serial
        constraint content_pk
            primary key,
    title              varchar(100)              not null,
    "directorOrAuthor" varchar(100),
    genre              varchar(50),
    "releaseYear"      integer,
    rating             double precision,
    "dateAdded"        date default CURRENT_DATE not null,
    categoryid         integer
        references category
);

create table reviews
(
    "reviewID"     serial
        constraint reviews_pk
            primary key,
    "userID"       integer               not null
        constraint "reviews_users_userID_fk"
            references users
            on update cascade,
    "contentID"    integer
        constraint "reviews_content_contentID_fk"
            references content
            on update cascade on delete cascade,
    "reviewText"   text,
    rating         double precision,
    "reviewDate"   date,
    access         boolean default false not null,
    categoryid     integer
        references category,
    "lastModified" date
);

create table roles
(
    "roleID"   serial
        constraint roles_pk
            primary key,
    "roleName" varchar(50) not null
        constraint roles_pk2
            unique
);

create table "userInformation"
(
    "userInformationID " serial
        constraint "userInformation_pk"
            primary key,
    "userID"             integer                                      not null
        constraint "userInformation_pk2"
            unique
        constraint "userInformation_users_userID_fk"
            references users
            on update cascade on delete cascade,
    name                 varchar(50),
    surname              varchar(50),
    "registrationDate"   date default set_default_registration_date() not null,
    avatar               bytea
);

create table users
(
    "userID" serial
        constraint users_pk
            primary key,
    login    varchar(50)       not null
        constraint users_pk2
            unique,
    email    varchar(100)      not null
        constraint users_pk3
            unique,
    password varchar(255)      not null,
    "roleID" integer default 2 not null
        constraint "users_roles_roleID_fk"
            references roles
            on update cascade on delete cascade
);




create function getreviewsbycontentid(contentid integer)
    returns TABLE(reviewid integer, userid integer, reviewtext text, rating double precision, reviewdate date)
    language plpgsql
as
$$
BEGIN
    RETURN QUERY
        SELECT reviewID, userID, reviewText, rating, reviewDate
        FROM reviews
        WHERE contentID = contentID;
END;
$$;

create function getusersbyrole(rolename character varying)
    returns TABLE(userid integer, login character varying, email character varying)
    language plpgsql
as
$$
BEGIN
    RETURN QUERY
        SELECT U."userID", U.login, U.email
        FROM users U
                 JOIN roles R ON U."roleID" = R."roleID"
        WHERE R."roleName" = roleName;
END;
$$;

create function set_default_registration_date() returns date
    language plpgsql
as
$$
BEGIN
    RETURN CURRENT_DATE;
END;
$$;

create function update_review_lastmodified() returns trigger
    language plpgsql
as
$$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW."lastModified" := CURRENT_TIMESTAMP;
    ELSE
        NEW."lastModified" := CURRENT_TIMESTAMP;
    END IF;
    RETURN NEW;
END;
$$;

