-- -------------------------------------------------------------
-- TablePlus 6.0.8(562)
--
-- https://tableplus.com/
--
-- Database: intus_windows
-- Generation Time: 2024-06-19 20:21:16.6350
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."migrations";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS migrations_id_seq;

-- Table Definition
CREATE TABLE "public"."migrations" (
    "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
    "migration" varchar(255) NOT NULL,
    "batch" int4 NOT NULL,
    PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "public"."urls";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS urls_id_seq;

-- Table Definition
CREATE TABLE "public"."urls" (
    "id" int8 NOT NULL DEFAULT nextval('urls_id_seq'::regclass),
    "original_url" varchar(255) NOT NULL,
    "shorten_url" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES
(1, '2024_06_19_092938_create_urls_table', 1);

INSERT INTO "public"."urls" ("id", "original_url", "shorten_url", "created_at", "updated_at") VALUES
(1, 'http://intus_windows.test/somethin1/somrething2/hello-world', 'http://intus_windows.test/somethin1/somrething2/JCDyOn', '2024-06-19 16:01:07', '2024-06-19 16:01:07'),
(2, 'http://lakin.com/', 'http://intus_windows.test/JQXSiu', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(3, 'http://www.raynor.com/voluptatem-enim-qui-expedita-nesciunt-et.html', 'http://intus_windows.test/fKPuaK', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(4, 'http://fadel.com/', 'http://intus_windows.test/SRQWm4', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(5, 'http://www.grady.net/', 'http://intus_windows.test/qmYHuN', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(6, 'https://www.cassin.com/recusandae-consequuntur-aut-nihil-libero-culpa', 'http://intus_windows.test/uuKzyj', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(7, 'http://quitzon.biz/qui-facilis-minus-laborum', 'http://intus_windows.test/Z7799E', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(8, 'https://moore.net/dolorem-quasi-quo-distinctio.html', 'http://intus_windows.test/18298C', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(9, 'http://www.klein.info/', 'http://intus_windows.test/HwrKIS', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(10, 'http://www.buckridge.com/earum-quae-commodi-illum-iure-nihil-qui-et', 'http://intus_windows.test/KFsaZP', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(11, 'http://www.tillman.net/consequatur-aspernatur-ut-ut-et', 'http://intus_windows.test/DYr9cL', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(12, 'http://www.harber.com/atque-rem-non-consectetur-molestiae-ex.html', 'http://intus_windows.test/VX5vEq', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(13, 'http://rath.com/', 'http://intus_windows.test/dvpoxv', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(14, 'http://www.veum.org/nihil-similique-quos-explicabo-recusandae-quia-ut.html', 'http://intus_windows.test/RnkfFG', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(15, 'https://sawayn.com/ab-facilis-sed-tenetur-aut-voluptatem.html', 'http://intus_windows.test/EmKsQg', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(16, 'http://www.parker.com/et-blanditiis-tempore-asperiores-deserunt-fuga', 'http://intus_windows.test/VQ0rCi', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(17, 'https://www.koch.com/modi-omnis-dolore-rerum-blanditiis', 'http://intus_windows.test/o9e702', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(18, 'http://bauch.org/', 'http://intus_windows.test/L8DYCW', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(19, 'http://www.reinger.com/placeat-veritatis-voluptas-reiciendis-in-ut-beatae-eveniet-et.html', 'http://intus_windows.test/e7gy7X', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(20, 'https://www.lynch.info/delectus-recusandae-quas-et-et-quae-a-dolor-totam', 'http://intus_windows.test/x9Gg3u', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(21, 'https://www.erdman.com/dolorum-impedit-voluptatem-atque-praesentium-id-est', 'http://intus_windows.test/BcFw2Q', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(22, 'http://hirthe.net/consequuntur-similique-nihil-mollitia-rerum-eum.html', 'http://intus_windows.test/RddBuU', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(23, 'http://bergstrom.com/debitis-labore-voluptatem-sunt-optio.html', 'http://intus_windows.test/TsgkcZ', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(24, 'http://satterfield.com/sint-rerum-aspernatur-saepe-non-ut', 'http://intus_windows.test/OdfXrX', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(25, 'http://reichel.com/suscipit-ratione-maxime-doloremque-facere-alias-omnis-animi.html', 'http://intus_windows.test/ISAIwI', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(26, 'https://www.greenholt.com/hic-sequi-eum-aliquid-laudantium-ex-nesciunt', 'http://intus_windows.test/1v4dUV', '2024-06-19 16:26:57', '2024-06-19 16:26:57'),
(52, 'http://upton.com/exercitationem-expedita-minus-impedit-et-aut-earum-et.html', 'http://intus_windows.test/b123e6', '2024-06-19 16:28:04', '2024-06-19 16:28:04'),
(53, 'https://chatgpt.com/', 'http://intus_windows.test/N2cOzY', '2024-06-19 17:07:15', '2024-06-19 17:07:15');



-- Indices
CREATE UNIQUE INDEX urls_unique ON public.urls USING btree (original_url, shorten_url);
