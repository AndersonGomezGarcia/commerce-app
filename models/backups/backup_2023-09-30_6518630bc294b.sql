SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `commerce_db`
--




CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paymentmethod` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


INSERT INTO clients VALUES
("1","","5"),
("3","","4"),
("4","","2"),
("13","","7"),
("15","","11");




CREATE TABLE `developers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `developers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


INSERT INTO developers VALUES
("1","3"),
("2","9");




CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valuepaid` float(12,1) NOT NULL,
  `method_payment` varchar(99) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `accreditationdate` varchar(25) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


INSERT INTO payments VALUES
("84","1231.0","deposit to the acount 123123 to123123","2023-09-14"),
("85","100.0","","");




CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `multimedia` longblob DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1482 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


INSERT INTO products VALUES
("1473","Pagina para restaurantes en donde se enfoca en la comodidad de los lugares y su exquisita comida","Restaurant","1231","","����\0JFIF\0\0\0\0\0\0��\0Compressed by jpeg-recompress��\0�\0					\"\"*%%*424DD\\					\"\"*%%*424DD\\��\0��\"\0��\0\0\0\0\0\0\0\0\0\0\0\0\0	��\0\0\0\0\0� :��x�XBh$��<�\'���\'��Nj�MX�O4�Y��i7;��d��,�,���������!�\'9���=�8\"Br�zf�=
�4� ��,�l��4*��s�1�#�ԥu��l�KŜ�sz��������j�^Sy�w�Ae�IE_d�m�k��k�|����9�4ȦOFq�\"f���ys��1훞
$�1�\"���JvZA$M�]m��m�Y�7;7������12r%T/)艮0�Vm���_~��n�2��
&զx�]���,��y$�Y�1�W��QRI%*ՉV�_EE��Ì$����O\"��M�;W4��|φ���=·;���ܠF�o�=S�鶮��$�j��c����P����t��R{�����sahV�Q�l�똬��/����ZN�B�ZhB
("1474","This is perfect for pool space, with dinamics transicions of wather and dinamic navigation literally, its perfect for call the atention of the persons to go your pool.","Page for Pool","100","","����\0JFIF\0\0H\0H\0\0��XICC_PROFILE\0\0\0HLino\0\0mntrRGB XYZ �\0\0	\0\01\0\0acspMSFT\0\0\0\0IEC sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0�-HP  \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0cprt\0\0P\0\0\03desc\0\0�\0\0\0lwtpt\0\0�\0\0\0bkpt\0\0\0\0\0rXYZ\0\0\0\0\0gXYZ\0\0,\0\0\0bXYZ\0\0@\0\0\0dmnd\0\0T\0\0\0pdmdd\0\0�\0\0\0�vued\0\0L\0\0\0�view\0\0�\0\0\0$lumi\0\0�\0\0\0meas\0\0\0\0\0$tech\0\00\0\0\0rTRC\0\0<\0\0gTRC\0\0<\0\0bTRC\0\0<\0\0text\0\0\0\0Copyright (c) 1998 Hewlett-Packard Company\0\0desc\0\0\0\0\0\0\0sRGB IEC61966-2.1\0\0\0\0\0\0\0\0\0\0\0sRGB IEC61966-2.1\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0XYZ \0\0\0\0\0\0�Q\0\0\0\0�XYZ \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0XYZ \0\0\0\0\0\0o�\0\08�\0\0�XYZ \0\0\0\0\0\0b�\0\0��\0\0�XYZ \0\0\0\0\0\0$�\0\0�\0\0��desc\0\0\0\0\0\0\0IEC http://www.iec.ch\0\0\0\0\0\0\0\0\0\0\0IEC http://www.iec.ch\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0desc\0\0\0\0\0\0\0.IEC 61966-2.1 Default RGB colour space - sRGB\0\0\0\0\0\0\0\0\0\0\0.IEC 61966-2.1 Default RGB colour space - sRGB\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0desc\0\0\0\0\0\0\0,Reference Viewing Condition in IEC61966-2.1\0\0\0\0\0\0\0\0\0\0\0,Reference Viewing Condition in IEC61966-2.1\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0view\0\0\0\0\0��\0_.\0�\0��\0\0\\�\0\0\0XYZ \0\0\0\0\0L	V\0P\0\0\0W�meas\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0�\0\0\0sig \0\0\0\0CRT curv\0\0\0\0\0\0\0\0\0\0\0\n\0\0\0\0\0#\0(\0-\02\07\0;\0@\0E\0J\0O\0T\0Y\0^\0c\0h\0m\0r\0w\0|\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�\0�
}��c��t�f�40&��:�Dxʐ�U07�G����~�M������Xm�۬B����[¢���4�om<�rr��@,8����57ǩ��@��+����P��\n�H\'Sǌ\',�-Ǽ�5�ns��]����_���:�]��skO�����2ڭ�ȭ��0�7ɞ�����<��(yt��	��H���n�\0?<z��=�d�N��B�O��G8����E)�w��U�Y������rGO���\'�#�.��~���pܜs��O�?��ۥ|s������A��7i�H�����9ɛ�\"kX���\0 [�Ȭ4SYaM�M�38[�z1B;��t4k?k�M�cө����8�U8Z�~�D1��v�$�53����yr@�H��q[���Ƙw8���%݈������-�шl�s����}�)��^oxI<��o�*���`��d��ϬwϜ ����9>L��3�������\0�;n:�Xu�<��98DXS�c��ލ������]��� ��kK7��wX�K��2֛���6��_YǸ���_�L\'��8�Ǘy��\0\'\0\0\0\0\0\0\0!1AQaq������ �����\0?�\"�3U\n˹��I��	�S&�D#�Sб},�!�}�1����
("1475","Creacion de pagina web especializada","Creacion de pagina web","123","","�PNG
d���n�[�ת1�FY�����s��ɱ׹&�)����#�z����Ƥl?ѧh�r��^m,�i���Ɇ�]�˽D�#2vݷr�$��	擏�BJ.��Z�>��$��܊��r��:L��F��(���_\\��!ִc@j�I��	\'�Q�92�*���D�KJ��%U޺s���*�J�ﯲ�T��=��2��vd��<���l�\'�E ay�n��ǭ��ޯߗ1��S��h
7�y�.��Q�e)�)��4��Ķ�8����2l{p^�;�����M�w^y��w�c�::�;�ٝ�>�C��:KDDDDDDDDDDDDDDDDTJ��$!�-h�ڤ6�!+XpwA,�C�x6.{��W���طÖC�t�_�z�qC�O=~T�����3����Iڱmk`��H�[��\nHƂ�R�wR.����B\0�Gl^*X@��e��(ڊ�I��!���/���R����C����J8�\0sXʏ.g|k����&��܌�tA.I�u�&��U���x|M���MPG[���\'];��_��a�@4�,�?����zK�?�\"[t�wm[o&�r@X����Uk�A�I��eS�r8F�1~��y�˺k7l3��lJb�=
�>���t��w���v�`��k)�����,��Q7�k6�nn���_o�[o�_��mo��9���v#��(�F������:���{���w�}?�����uh*��?�ճw�{��{,��+�N�Z��r�r�������׿h�{!�Ɩ��I�3�����O�~��O:��簍�n��d��Q�����9}�w��,�{��������;v4[�^�wQϖ�uE��R���h��=�K�S9��\\����?�>��ZPX!ʵ��m�m|�������w�]Z�h����cF�Ӳ�����_Y�8�]k��S�K����}Ǳ|���������� �\'�(k�1ڭgٰq��_MD����4H�σ���ZN*vi;��y˙�u\\ߪk<�g�:�.�1�WԳ��\\�Bԁ8�⹳��+���{�X�;j��\\��HԷa�Gr�� E��3�b��讏{�����B������?������[�Mm��\"�cټ°�ꅸǊ��u?5W�]�h7b}�_���S�έu���80����G�\\�\'�.k���V9��ѣ�k�>����m�W]]z
K?�z\"q��=\'����v�����no*v;�_���w�~�����ˮ�Y����5��c��S�N\'���R���\"D|��[�U1�,�_k���^1�]o�`j8�-Ω�kb�s>}��Y<���3��k��\0\0\0\0��tD����;i�a��2��o�V�c�=���=��c��կ�����Ӯ]?I\0��]q��Y�}��۝�oߖ�~�mY��o����ݝŃi\\Wɑ�6߾���uO�#��>���4�wFjGOϔ,}�ŗ���|&��k?6
���Vt�^���#��������1�#r�G�H�7����6K�>�w_�x�!�����_h`�>�Y�/�sRpYA��;z�������Qhw��I�����w�H�.����5Ts�m�����?�ϯ��TU\\%��I�ϙ	�?�x�?��{r%?>�%vйT���B��%�:ij�8����|^��t
;�P���<R@zDSb�:oᆂ͖��hٚ�{�����:��kF���������9�5���߈�2�X��b?u��s��9~��ϛ)��\\.�7�%��>!K_���k��\'/J�<`?�3��� _��$y
n�ab��E4�{ѿ�\0P
tGeLӆ�PK�&�=I�m��Z��~�>�und�R(W�6�a���U�>�����M������ͦPZ]|�&�V�J�_u\\{�V�K�+n[i������D}Cm-w������!M�c@�fY���,��$�6�A�\'�\n�h�^�JܾA�E��S��8aB�M��M=��R����*���\0�U�9j�N��k�HSG���}6M�i0�����_�w%�w��_E%�mj� �z����3qm����jOì
īV�6�M�\0�4�Et�i�~�V]��m*)�)l���^]�zx�!�\0�
�\'�aÆ�޽Z=,�U|�ʏ�7���|�>�ѿ�������݌ J�
�7̶m��g��>$`Z�U�رc����1�w�>cu�q�FK#���3�~[�:�����]��OZi����������DogYx٥��I��\0\0\0\0\0\0�� Xv׮���.Pm�F���[WW�u\n�)\0h=�8_�ż\0�y\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0:��@F\n��\n�����4�B��{��n�
;7+3̹�Q�Xܖ$��ƛ����o����~5���~����F��u�7�4�~�����ݛ\0\0\0\0\0\0\0\0\0\0\0���&Q���X�|���/<<c�[,��s��|��;���BL��r�In��|��ꄷN�8΃������%�Fe塒p����9���j���~N?��tu*elP�[o�Y,�+�=�gNz��ݲZ�֗�
�PhT�`0H�K���k�ߵj�
�E�2p�l��TR�.Yb�|�����v�\0\0\0\0\0\0\0\0\0\0\0���\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0@�.Z��x���(��������a��Ο`*/�>�W���k��\'���}:\"��\'�bY1�v����5b��M�岜����~(��g�ڠmˈe5��U\"A��W��ִ��w��E{s�ܛ_��`���r�o��Qf2r�������R\'2�51hTcqyu�!��r�\"�����ZPR�*fpt�3qG\0\0\0\0\0\0\0\0\0\0`~�	\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0f��\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\03�@h\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0�\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0Eio_n������Ǩ%�I��bF-��P���fMd��mXd�RY[���Z2c;�}/�,əoVDE�a�t>�@�RFm�7&Ɂ1��Ngef�����4.�H>�A���i��5�ڲ�IF���hJ�����ZZ�߰���c=2��1)U�ͥS����oMY�h�b�֘H:�Ƥne�b���$6����9mא��E\0\0\0\0\0\0\0\0\0\0\0j��\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0@������x<.{��b����P)�k��9�?���Fm,���1j}�|ҨE�S��pTf��Yg6J�4�X��t;xr@R�󥭩C�ˣ�o1*�-��#�̛�2�x�Q>�S��ʉ�9	����\"	5�m?���f.��m�,�ߥ���N$��S�~�J�ԛ�q�����X#G�ҘX^�^g�.vN_��\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0`F
L�Z�=����)x����ctd���(�}ǅ�\n�K�\\Km�V+��f��~��
����v��5�����PC���qRcn�)b\\�c��Ƨ#šڷ��s�g�{\"�M�!I�{��DZ�ko�\\�D����<~?��S��ִ�4��~����#�}�4�\\g^�<����zͿx\0\0\0\0\0\0\0\0F� 4\0\0\0\0\0\0\0\0\0\0������6;��hi�UUF��WWs>�?zٺ{OUF��ɓ\'E_�`�\'n\\\\rqI�Sz�_��Jh��(�l�wK\n��{٬U�|��X�se�\"�μ>�:����q\n.W\"b���6��O/��-�x����D�˱�iMS\0�Rş\\{\"9�\'6w�O�3�#�C>o�ֆ2�SO:=�������/���|�1}v��.{���������;*r\0\0\0\0\0\0\0`�L�49�.�\0\0\0\0\0\0\0\0\0\0�1g���\\�y {�Z<���U�������=��7���0^5~tq\\��K�A���O޾6���������V����|��垷���qm,���,���G��5�/�=���q�b�o�����|^I�׵s�g�ik*�\'���y+m٬�e����sQ�M�EΛW��?����i\0\0\0\0\0\0\0\0�|�\0\0\0\0\0\0\0\0\0\0Ơ�G����W�ۣo��h�z�ob��֨Vs�4�������`|�4irLd5Ӧǒ�k��/)����-q��W��JH��C.g�6�:�.��3��\\�r�}�|���f���y��Ǡ���5��]��r\n*Wb]�9�|R�z��R.�y}n�UJ�A_ְ**�뵶x�֛�o���\\L]�����~�r�	\0\0\0\0\0\0\0��9���2%\0\0\0\0\0\0\0\0\0\0\0�z{ǋ/�ć~0����or�U�Y