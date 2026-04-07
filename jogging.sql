-- ============================================
-- Base de données : Jogging de l'IFOSUP
-- Evaluation BES Designer – 5XDEV-1
-- ============================================

CREATE DATABASE IF NOT EXISTS jogging;
USE jogging;

-- ============================================
-- Table : news
-- ============================================
CREATE TABLE IF NOT EXISTS news (
    NewID      INT          AUTO_INCREMENT PRIMARY KEY,
    NewTitre   VARCHAR(255) NOT NULL,
    NewContenu TEXT         NOT NULL
);

-- ============================================
-- Table : resultats
-- ============================================
CREATE TABLE IF NOT EXISTS resultats (
    ResID     INT         AUTO_INCREMENT PRIMARY KEY,
    ResNom    VARCHAR(100) NOT NULL,
    ResPrenom VARCHAR(100) NOT NULL,
    ResSexe   CHAR(1)      NOT NULL,
    ResTps    TIME         NOT NULL
);

-- ============================================
-- Données de départ : news
-- ============================================
INSERT INTO news (NewTitre, NewContenu) VALUES
('Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.'),
('Nunc viverra imperdiet', 'Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.\n\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.');

-- ============================================
-- Données de départ : résultats (triés par temps)
-- ============================================
INSERT INTO resultats (ResNom, ResPrenom, ResSexe, ResTps) VALUES
('ZIEUVAIR',            'Bruno',   'M', '00:14:08'),
('ALAVANILLESIOUPLAIT', 'Douglas', 'M', '00:14:17'),
('UJOUR',               'Fred',    'M', '00:14:23'),
('MENSOIF',             'Gérard',  'M', '00:14:42'),
('DRÉSSAMÈRE',          'Ivan',    'M', '00:15:19'),
('UMUL',                'Jacques', 'M', '00:15:24'),
('HONNETE',             'Camille', 'F', '00:15:25'),
('AVULEUR',             'Edith',   'F', '00:15:27'),
('AVRANTE',             'Hélène',  'F', '00:15:41'),
('ORDINE',              'Kid',     'M', '00:15:59'),
('TROUILLE',            'Lassie',  'F', '00:16:05'),
('HONNETE',             'Marie',   'F', '00:16:19'),
('RIENDEMOI',           'Nathan',  'M', '00:16:34'),
('OTINE',               'Nick',    'M', '00:16:43'),
('HERME',               'Olaf',    'M', '00:17:06');
