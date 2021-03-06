USE [master]
GO
/****** Object:  Database [EANW]    Script Date: 6/24/2014 10:14:24 AM ******/
CREATE DATABASE [EANW]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'EANW', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\EANW.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'EANW_log', FILENAME = N'c:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\EANW_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [EANW] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [EANW].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [EANW] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [EANW] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [EANW] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [EANW] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [EANW] SET ARITHABORT OFF 
GO
ALTER DATABASE [EANW] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [EANW] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [EANW] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [EANW] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [EANW] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [EANW] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [EANW] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [EANW] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [EANW] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [EANW] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [EANW] SET  DISABLE_BROKER 
GO
ALTER DATABASE [EANW] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [EANW] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [EANW] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [EANW] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [EANW] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [EANW] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [EANW] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [EANW] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [EANW] SET  MULTI_USER 
GO
ALTER DATABASE [EANW] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [EANW] SET DB_CHAINING OFF 
GO
ALTER DATABASE [EANW] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [EANW] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [EANW]
GO
/****** Object:  Table [dbo].[Computers]    Script Date: 6/24/2014 10:14:24 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Computers](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[asset_tag] [varchar](20) NOT NULL,
	[description] [varchar](50) NOT NULL,
	[department] [int] NOT NULL,
	[location] [int] NOT NULL,
	[license] [int] NOT NULL,
	[has_win7] [bit] NOT NULL,
	[condition] [int] NOT NULL,
 CONSTRAINT [PK_Computers] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_Asset_Tag] UNIQUE NONCLUSTERED 
(
	[asset_tag] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Conditions]    Script Date: 6/24/2014 10:14:25 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Conditions](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NOT NULL,
 CONSTRAINT [PK_StatusNames] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Departments]    Script Date: 6/24/2014 10:14:25 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Departments](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Departments] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Licenses]    Script Date: 6/24/2014 10:14:25 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Licenses](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](50) NOT NULL,
 CONSTRAINT [PK_OperatingSystems] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Locations]    Script Date: 6/24/2014 10:14:25 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Locations](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[abbreviation] [varchar](10) NOT NULL,
	[full_description] [varchar](50) NOT NULL,
 CONSTRAINT [PK_locations] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Computers]  WITH CHECK ADD  CONSTRAINT [FK_Computers_Departments] FOREIGN KEY([department])
REFERENCES [dbo].[Departments] ([id])
GO
ALTER TABLE [dbo].[Computers] CHECK CONSTRAINT [FK_Computers_Departments]
GO
ALTER TABLE [dbo].[Computers]  WITH CHECK ADD  CONSTRAINT [FK_Computers_Locations] FOREIGN KEY([location])
REFERENCES [dbo].[Locations] ([id])
GO
ALTER TABLE [dbo].[Computers] CHECK CONSTRAINT [FK_Computers_Locations]
GO
ALTER TABLE [dbo].[Computers]  WITH CHECK ADD  CONSTRAINT [FK_Computers_OperatingSystems] FOREIGN KEY([license])
REFERENCES [dbo].[Licenses] ([id])
GO
ALTER TABLE [dbo].[Computers] CHECK CONSTRAINT [FK_Computers_OperatingSystems]
GO
USE [master]
GO
ALTER DATABASE [EANW] SET  READ_WRITE 
GO
