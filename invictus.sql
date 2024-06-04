-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 04, 2024 alle 23:25
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invictus`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `genere` varchar(9) DEFAULT NULL,
  `data_n` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tel_c` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`nome`, `cognome`, `genere`, `data_n`, `email`, `password`, `tel_c`, `id`) VALUES
('Francesco', 'Mirenda', 'uomo', '2024-05-17', 'francescomirenda1112@gmail.com', '$2y$10$tqqxxhLwtqzhNDBDz6iKiui.2akFwAIPrsxuwBU22dzpfoCy3Heta', '3484663564', 1),
('geppeto', 'sans', 'uomo', '2024-05-04', 'lucia18586@tisc', '$2y$10$t0JOBXtk2yRNRWJtU9GlBednsv5UttECuGrfnA4oWNTI8HWSIH4dq', '55484694129', 2),
('asdwe', 'wadwas', 'uomo', '2024-05-05', 'francesco.m345@ail.com', '$2y$10$T5iMpsa/2K17kw2cYT9vQOyKn6ymiLp3VRrKyatvf1MCFvWKH9l22', '348466434', 3),
('Frwdadaesco', 'Mirenwsdqqdda', 'altro', '2024-05-18', 'francescomirenda1112@gmail.comwer', '$2y$10$wYTSRsgJXxVZhqvCSVssh.7zJWlNH8CL2YEiEYMORsoH7FnIROTqu', '3484642342', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `id` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `immagine_principale` varchar(255) NOT NULL,
  `immagine_segnalibro` varchar(255) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `intestazione` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`id`, `data`, `titolo`, `descrizione`, `link`, `immagine_principale`, `immagine_segnalibro`, `categoria`, `intestazione`) VALUES
(1, '20 MARZO 2024', 'Reset metabolico per dimagrire: come si fa? Schema', 'Il reset metabolico è una strategia che permette di dimagrire alzando le calorie e di raggiungere una composizione corporea migliore, specialmente quando la dieta è abbinata ad un allenamento con…', '#', '../img/largetab.png', '../img/bookmarkno.png', 'METABOLISMO', 1),
(2, '19 MARZO 2024', 'Esercizi per le gambe', 'Esercizi per dimagrire le cosce e le gambe', '#', '../img/invictusimg1.png', '../img/bookmarkno.png', 'ALLENAMENTO AL FEMMINILE', 2),
(3, '18 MARZO 2024', 'Allenamento per il petto', 'Allenamento panca piana nella home gym Lacertosus', '#', '../img/invictusimg2.png', '../img/bookmarkno.png', 'ESERCIZI PALESTRA', 2),
(4, '17 MARZO 2024', 'Scheda per i bicipiti', 'come impostarla e programma', '#', '../img/invictusimg3.png', '../img/bookmarkno.png', 'SCHEDA PALESTRA', 2),
(5, '14 MARZO 2024', '3 diete efficaci che funzionano', 'Scopri tre diete efficaci che hanno dimostrato di funzionare per perdere peso in modo sano e sostenibile.', '#', '../img/invictusimg4.png', '../img/bookmarkno.png', NULL, 2),
(6, '13 MARZO 2024', '', 'Indice Glicemico', '#', '../img/invictusimg9.jpg', '../img/bookmarkno.png', 'STRATEGIE PER DIMAGRIRE', 0),
(7, '11 MARZO 2024', '', 'Descrizione dell\'articolo sulla colazione proteica', '#', '../img/colazione-proteica-2-640x360.jpg', '../img/bookmarkno.png', NULL, 0),
(8, '10 MARZO 2024', '', 'Dieta chetogenica: pro e contro', '#', '../img/invictusimg8.jpg', '../img/bookmarkno.png', NULL, 0),
(9, '13 MARZO 2024', '', 'Diete drastiche: cosa mangiare e rischi', '#', '../img/invictusimg6.jpg', '../img/bookmarkno.png', 'STRATEGIE PER DIMAGRIRE', 0),
(10, '7 MARZO 2024', '', 'Dieta alcalina: cosa mangiare e come funziona', '#', '../img/invictusimg10.jpg', '../img/bookmarkno.png', NULL, 0),
(11, '6 MARZO 2024', '', 'TUT (Timer Under Tension)', '#', '../img/invictusimg5.png', '../img/bookmarkno.png', 'STRATEGIE PER DIMAGRIRE', 0),
(12, '5 MARZO 2024', '', 'Dieta FODMAP: come funziona?', '#', '../img/invictusimg7.jpg', '../img/bookmarkno.png', NULL, 0),
(13, '4 MARZO 2024', '', 'Descrizione dell\'articolo sulla colazione per dimagrire', '#', '../img/5colaz.jpg', '../img/bookmarkno.png', NULL, 0),
(14, '3 MARZO 2024', '', 'Spuntini proteici: i 10 migliori', '#', '../img/6coldol.jpg', '../img/bookmarkno.png', NULL, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

CREATE TABLE `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `immagine` varchar(255) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `nome`, `immagine`, `descrizione`) VALUES
(1, 'Curl Bicipiti Alternato con Manubrio', 'https://wger.de/media/exercise-images/1192/651a4535-8210-4dbd-8f06-61d95fdd9963.png', 'Impugnare due bilancieri, le braccia sono distese, le mani sono sul fianco, i palmi rivolti verso l\'interno. Piegare un braccio alla volta e portare il peso con un movimento veloce verso l\'alto. Allo stesso tempo, ruotate le braccia di 90 gradi all\'inizio del movimento. Nel punto più alto, ruotate un po\' il peso verso l\'esterno. Senza fare pause, riportare il braccio verso il basso, lentamente, e fare lo stesso con l\'altro braccio.\n\nNon lasciate che il corpo oscilli durante l\'esercizio, tutto il lavoro è svolto dai bicipiti, che sono gli unici muscoli che devono muoversi (fate attenzione ai gomiti).'),
(2, 'Trazioni orizzontali con trx', 'https://wger.de/media/exercise-images/959/53a5e008-bc31-4ee0-9463-69a858c2ec18.png', 'È l\'esercizio propedeutico dei Pull Up. I muscoli che vengono coinvolti in questo esercizio di tirata sono il&nbsp;<b style=\"\">gran dorsale, deltoide e bicipiti</b>.');

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizipreferiti`
--

CREATE TABLE `esercizipreferiti` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_esercizio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `esercizipreferiti`
--

INSERT INTO `esercizipreferiti` (`id`, `id_utente`, `id_esercizio`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_articolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`id`, `id_utente`, `id_articolo`) VALUES
(10, 1, 7),
(11, 1, 6),
(12, 1, 5),
(13, 1, 11),
(14, 1, 12),
(15, 1, 13),
(16, 1, 14),
(17, 1, 8),
(18, 1, 4),
(19, 1, 9),
(20, 1, 10);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `esercizi`
--
ALTER TABLE `esercizi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `esercizipreferiti`
--
ALTER TABLE `esercizipreferiti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vin1` (`id_utente`),
  ADD KEY `vin2` (`id_esercizio`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_articolo` (`id_articolo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `esercizipreferiti`
--
ALTER TABLE `esercizipreferiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esercizipreferiti`
--
ALTER TABLE `esercizipreferiti`
  ADD CONSTRAINT `vin1` FOREIGN KEY (`id_utente`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `vin2` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`id_articolo`) REFERENCES `articoli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
