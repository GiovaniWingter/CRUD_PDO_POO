USE [base_php]
GO

/****** Object:  Table [dbo].[cliente]    Script Date: 14/05/2013 17:57:01 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[cliente](
	[id_cliente] [int] IDENTITY(1,1) NOT NULL,
	[nome_cliente] [varchar](80) NULL,
	[rg_cliente] [char](14) NULL,
	[cpf_cliente] [char](11) NULL,
	[sexo_cliente] [char](1) NULL,
	[dtnasc_cliente] [date] NULL,
	[email_cliente] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO