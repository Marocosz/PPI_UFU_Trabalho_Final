CREATE TABLE IF NOT EXISTS `Funcionario` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senhahash` varchar(255) NOT NULL,
  `EstadoCivil` varchar(50) DEFAULT NULL,
  `DataNascimento` date DEFAULT NULL,
  `Funcao` varchar(100) DEFAULT NULL,
  `UltimoLogin` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Contato` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `Mensagem` text NOT NULL,
  `Datahora` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Medico` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Especialidade` varchar(100) NOT NULL,
  `CRM` varchar(20) NOT NULL,
  PRIMARY KEY (`Codigo`),
  UNIQUE KEY `CRM` (`CRM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Paciente` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Agendamento` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Datahora` datetime NOT NULL,
  `CodigoMedico` int(11) DEFAULT NULL,
  `CodigoPaciente` int(11) DEFAULT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `CodigoMedico` (`CodigoMedico`),
  KEY `CodigoPaciente` (`CodigoPaciente`),
  CONSTRAINT `Agendamento_ibfk_1` FOREIGN KEY (`CodigoMedico`) REFERENCES `Medico` (`Codigo`),
  CONSTRAINT `Agendamento_ibfk_2` FOREIGN KEY (`CodigoPaciente`) REFERENCES `Paciente` (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;