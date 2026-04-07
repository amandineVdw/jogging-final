-- ============================================================
-- Jogging de l'IFOSUP — Base de données complète
-- Version : Ultimate Pro +++ avec thèmes et humour
-- ============================================================

-- CREATE DATABASE IF NOT EXISTS jogging;
-- USE jogging;

-- ============================================================
-- Table : news (avec tone et date)
-- ============================================================
CREATE TABLE IF NOT EXISTS news (
    NewID      INT          AUTO_INCREMENT PRIMARY KEY,
    NewTitre   VARCHAR(255) NOT NULL,
    NewContenu TEXT         NOT NULL,
    NewTone    VARCHAR(20)  NOT NULL DEFAULT 'officiel',
    NewDate    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Table : resultats
-- ============================================================
CREATE TABLE IF NOT EXISTS resultats (
    ResID     INT          AUTO_INCREMENT PRIMARY KEY,
    ResNom    VARCHAR(100) NOT NULL,
    ResPrenom VARCHAR(100) NOT NULL,
    ResSexe   CHAR(1)      NOT NULL,
    ResTps    TIME         NOT NULL
);

-- ============================================================
-- NEWS OFFICIELLES
-- Ton : neutre, professionnel. Avec une subtile touche de second
-- degré que seuls les gens qui ont vu les autres thèmes remarquent.
-- ============================================================
INSERT INTO news (NewTitre, NewContenu, NewTone) VALUES

('Bienvenue sur le site du Jogging de l\'IFOSUP',
'Le jogging aura lieu cette année comme les années précédentes. Les participants courront. Un gagnant sera désigné. Les autres auront également participé, ce qui compte aussi, d\'une certaine façon.',
'officiel'),

('Rappel : l\'échauffement est obligatoire',
'Un échauffement collectif est prévu 15 minutes avant le départ. La participation est vivement recommandée. Sourire pendant l\'échauffement est facultatif mais apprécié par l\'organisation.',
'officiel'),

('Les inscriptions sont ouvertes',
'Les inscriptions pour l\'édition de cette année sont désormais ouvertes. Le formulaire est disponible auprès de l\'administration. Les places sont limitées. Enfin, techniquement non, mais cela crée un sentiment d\'urgence utile.',
'officiel');

-- ============================================================
-- NEWS DARK
-- Ton : Gen X deadpan. Factuel. Légèrement fatigué de tout.
-- L'humour est dans ce qu'on ne dit pas.
-- ============================================================
INSERT INTO news (NewTitre, NewContenu, NewTone) VALUES

('Nouveau record : quelqu\'un a survécu à l\'échauffement',
'Un participant a terminé les 10 minutes d\'échauffement sans incident. Gilles LETPARBALLES a commenté : "C\'est un grand jour." Personne n\'avait demandé son avis. Il l\'a donné quand même. C\'est son jogging.',
'dark'),

('Les genoux : un organe surestimé',
'Une étude menée par personne en particulier confirme ce que les joggeurs savent depuis des années : les genoux sont optionnels après 40 ans. Notre président Gilles a acquiescé, puis s\'est assis prudemment et n\'a plus bougé pendant 20 minutes. L\'étude ne sera pas publiée.',
'dark'),

('HERME Olaf a fini. C\'est noté.',
'17 minutes et 6 secondes. Dernier. Il était là au départ. Il était là à l\'arrivée. Tout le monde était déjà reparti. Il a franchi la ligne quand même. On ne dit pas ça souvent, mais c\'est peut-être le truc le plus courageux de la journée. Ou pas. On ne sait pas. Il n\'a rien dit.',
'dark'),

('Les inscriptions sont ouvertes. Ou fermées. On vérifie.',
'Le formulaire d\'inscription est en ligne. Le serveur répond la plupart du temps. Vos données seront stockées dans une base MySQL gérée par quelqu\'un qui a appris PDO récemment. Toute la confiance du monde. Bonne chance à tous.',
'dark');

-- ============================================================
-- NEWS INNOJP
-- Ton : stand-up belge. Première personne. "Dans la vie, quoi."
-- Basé sur une histoire vraie. Enfin, probablement.
-- ============================================================
INSERT INTO news (NewTitre, NewContenu, NewTone) VALUES

('True story : j\'ai participé au jogging de l\'IFOSUP. Dans la vie, quoi.',
'Je vais être honnête. Quand Gilles m\'a dit qu\'il organisait un jogging, j\'ai répondu oui. Pas parce que j\'aime courir. Parce que quand quelqu\'un s\'appelle LETPARBALLES et qu\'il vous invite à faire du sport, vous dites oui par curiosité pure. Arrivé sur place, un monsieur m\'a regardé et m\'a dit : "Tu es le premier Rwandais à participer !" Je suis né à Kigali. J\'ai été adopté à 4 mois. J\'ai grandi à Namur. Je mange des tartines au speculoos. Mais ok. Je représente le Rwanda. Dans la vie, quoi.',
'innojp'),

('Mes deux papas m\'ont fait des pancartes. Des pancartes.',
'Jean-Pierre et Marc sont venus me supporter sur le bord de la route. Ils avaient préparé des pancartes. Pour un jogging de quartier un dimanche matin. Jean-Pierre avait écrit "ALLEZ NOTRE BOUNTY" en lettres orange sur carton. Marc lui avait dit que c\'était peut-être pas le mot le plus approprié. Jean-Pierre a répondu : "C\'est de l\'amour, Marc." La dame à côté d\'eux a pris une photo. J\'ai continué à courir en faisant semblant de ne pas les voir. Dans la vie, quoi.',
'innojp'),

('ZIEUVAIR Bruno arrive toujours premier. J\'ai une théorie. Je dis rien mais j\'ai une théorie.',
'Bruno ZIEUVAIR finit premier. Toujours. Chaque année. Sans exception. J\'ai analysé la situation. Au Rwanda, on a une certaine réputation dans le monde de la course à pied. Je suis Rwandais. J\'ai fini 11ème. Bruno est de Wavre. Il habite Rue de la Chapelle. Il a fini premier en 14 minutes 8 secondes. Je ne fais aucune conclusion. Je note juste les faits. Dans la vie, quoi.',
'innojp'),

('L\'échauffement collectif : une secte. Je dis ce que je vois.',
'Il y a un moment dans les joggings organisés qui me met profondément mal à l\'aise. L\'échauffement collectif. Tout le monde en cercle, en legging, fait les mêmes gestes en même temps pendant qu\'une coach crie "ET ON SOURIT !" Il était 9h du matin. Un dimanche. Je ne souriais pas. Pas parce que j\'étais mécontent. Parce que je venais de me réveiller et que je me demandais encore comment j\'en étais arrivé là. Dans la vie, quoi.',
'innojp'),

('La question. Toujours la question.',
'"Mais tu viens d\'où vraiment ?" Je venais de franchir la ligne d\'arrivée. J\'avais couru 10 kilomètres. Les jambes tremblaient. Quelqu\'un — souriant, sincère, vraiment curieux — m\'a demandé d\'où je venais vraiment. De Namur. Je viens de Namur. J\'ai un accent wallon. J\'aime les frites sauce andalouse et les émissions de jardinage sur RTL. Mais ok. On recommence. Dans la vie, quoi.',
'innojp');

-- ============================================================
-- RÉSULTATS
-- ============================================================
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
