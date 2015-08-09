-- Mysql Server version: 5.6.14-log - Source distribution

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `user_nicename` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL,
  `user_status` int(10) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `color` varchar(6) NOT NULL,
  `font_color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `valid_document` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `street` varchar(256) NOT NULL,
  `number` varchar(10) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `suburb` varchar(55) NOT NULL,
  `state` varchar(32) NOT NULL,
  `town` varchar(64) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `phone_one` varchar(25) NOT NULL,
  `phone_two` varchar(25) NOT NULL,
  `registered_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` tinyint(3) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transacao` varchar(100) NOT NULL,
  `status_entrega` int(10) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_area`
--

CREATE TABLE IF NOT EXISTS `delivery_area` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` int(10) NOT NULL,
  `zipcode` varchar(9) NOT NULL,
  `street` varchar(255) NOT NULL,
  `town` int(10) NOT NULL,
  `suburb` bigint(19) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zipcode` (`zipcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=753 ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

CREATE TABLE IF NOT EXISTS `delivery_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(255) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `endereco` varchar(155) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(55) NOT NULL,
  `complemento` varchar(155) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` int(10) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `cnpj` varchar(19) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `obs` mediumtext NOT NULL,
  `tel1` varchar(12) NOT NULL,
  `tel2` varchar(12) NOT NULL,
  `resp1` varchar(55) NOT NULL,
  `resp2` varchar(55) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `data` date NOT NULL,
  `website` varchar(255) NOT NULL,
  `website_fb` varchar(255) NOT NULL,
  `gmap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `default` varchar(3) NOT NULL,
  `logotipo` varchar(255) NOT NULL,
  `slider` varchar(255) NOT NULL,
  `ativo` varchar(1) NOT NULL,
  `IM` varchar(25) NOT NULL,
  `cnae` int(10) NOT NULL,
  `crt` int(10) NOT NULL,
  `abre` time NOT NULL,
  `fecha` time NOT NULL,
  `frontend` mediumtext NOT NULL,
  `logotipo_admin_area` varchar(55) NOT NULL,
  `valor_entrega` decimal(6,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `factsheet`
--

CREATE TABLE IF NOT EXISTS `factsheet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `final_product` int(10) NOT NULL,
  `ingredient` int(10) NOT NULL,
  `unit` varchar(3) NOT NULL,
  `qup` int(10) NOT NULL,
  `vi` decimal(6,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=419 ;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE IF NOT EXISTS `fixed_assets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `desc_item` varchar(255) NOT NULL,
  `date_buy` date NOT NULL,
  `qty` int(10) NOT NULL,
  `order_id` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(255) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `endereco` varchar(155) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `bairro` varchar(55) NOT NULL,
  `complemento` varchar(155) NOT NULL,
  `pais` int(10) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` int(10) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `doc_valido1` varchar(19) NOT NULL,
  `doc_valido2` varchar(15) NOT NULL,
  `obs` mediumtext NOT NULL,
  `tel1` varchar(12) NOT NULL,
  `tel2` varchar(12) NOT NULL,
  `resp1` varchar(55) NOT NULL,
  `resp2` varchar(55) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `data` date NOT NULL,
  `website` varchar(255) NOT NULL,
  `website_fb` varchar(255) NOT NULL,
  `gmap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `default` varchar(3) NOT NULL,
  `logotipo` varchar(255) NOT NULL,
  `ativo` varchar(1) NOT NULL,
  `doc_valido3` varchar(25) NOT NULL,
  `cnae` int(10) NOT NULL,
  `crt` int(10) NOT NULL,
  `abre` time NOT NULL,
  `fecha` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE IF NOT EXISTS `gateways` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `currency_code` varchar(4) NOT NULL,
  `business_id` varchar(255) NOT NULL,
  `return_url` varchar(255) NOT NULL,
  `notify_url` varchar(255) NOT NULL,
  `useit` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(64) NOT NULL,
  `unit` varchar(3) NOT NULL,
  `scale_unit` int(10) NOT NULL,
  `minimum_stock` int(10) NOT NULL,
  `stock_level` int(10) NOT NULL,
  `unit_cost` decimal(6,2) NOT NULL,
  `supplier` int(10) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7677 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_chart_accounts`
--

CREATE TABLE IF NOT EXISTS `invoices_chart_accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categ` varchar(100) NOT NULL,
  `categ_name` varchar(155) NOT NULL,
  `code` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `essential` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_receivable`
--

CREATE TABLE IF NOT EXISTS `invoices_receivable` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL DEFAULT '0',
  `order_id` varchar(32) NOT NULL,
  `date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `serv_desc` varchar(255) DEFAULT NULL,
  `serv_qty` varchar(12) DEFAULT NULL,
  `serv_rate` decimal(6,2) DEFAULT '0.00',
  `serv_amt` decimal(6,2) DEFAULT '0.00',
  `serv_tax` enum('yes','no') NOT NULL,
  `shipping` decimal(5,2) DEFAULT '0.00',
  `subtotal` decimal(6,2) DEFAULT '0.00',
  `salestax` decimal(6,2) DEFAULT '0.00',
  `discount` decimal(6,2) DEFAULT '0.00',
  `note` mediumtext,
  `total` decimal(6,2) DEFAULT '0.00',
  `status` enum('pending','paid','overdue','terminated','renegotiated','free','draft') NOT NULL,
  `reference` varchar(2) DEFAULT NULL,
  `company` int(10) NOT NULL,
  `insert_by` int(10) NOT NULL,
  `update_by` int(10) NOT NULL,
  `NF` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payable`
--

CREATE TABLE IF NOT EXISTS `invoice_payable` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(32) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `qty` varchar(12) DEFAULT NULL,
  `rate` decimal(6,2) DEFAULT '0.00',
  `tax` decimal(6,2) NOT NULL,
  `salestax` decimal(6,2) DEFAULT '0.00',
  `amt` decimal(6,2) DEFAULT '0.00',
  `shipping` decimal(5,2) DEFAULT '0.00',
  `interest` decimal(10,2) NOT NULL,
  `fine` decimal(10,2) NOT NULL,
  `discount` decimal(6,2) DEFAULT '0.00',
  `subtotal` decimal(6,2) DEFAULT '0.00',
  `total` decimal(6,2) DEFAULT '0.00',
  `status` enum('pending','paid','terminated','due','draft') NOT NULL,
  `reference_id` int(10) DEFAULT NULL,
  `recurring_bill` tinyint(3) NOT NULL,
  `prediction_account` tinyint(3) NOT NULL,
  `user_register` int(10) NOT NULL,
  `user_low_account` int(10) NOT NULL,
  `cashier_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `nota_fiscal` varchar(255) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `notes` mediumtext,
  PRIMARY KEY (`id`),
  KEY `idx_1` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=180 ;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `moip_nasp`
--

CREATE TABLE IF NOT EXISTS `moip_nasp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transacao` varchar(100) NOT NULL,
  `valor` int(10) NOT NULL,
  `status_pagamento` int(10) NOT NULL,
  `cod_moip` int(10) NOT NULL,
  `forma_pagamento` int(10) NOT NULL,
  `tipo_pagamento` varchar(100) NOT NULL,
  `email_consumidor` varchar(150) NOT NULL,
  `data_hora_transacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_method` int(10) NOT NULL,
  `order_status_id` int(10) NOT NULL,
  `date_last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_observations`
--

CREATE TABLE IF NOT EXISTS `orders_observations` (
  `order_id` int(10) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `scheduling` datetime NOT NULL,
  `options` varchar(32) NOT NULL,
  `cupom` varchar(8) NOT NULL,
  `cupom_number` varchar(32) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) NOT NULL,
  `products_id` int(10) NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_tax` decimal(7,4) NOT NULL,
  `products_final_price` decimal(15,4) NOT NULL,
  `products_quantity` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=331 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE IF NOT EXISTS `orders_status` (
  `orders_status_id` int(10) NOT NULL AUTO_INCREMENT,
  `language_id` int(10) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) NOT NULL,
  PRIMARY KEY (`orders_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `pcs_orders`
--

CREATE TABLE IF NOT EXISTS `pcs_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `input_address` varchar(255) NOT NULL,
  `input_town` varchar(64) NOT NULL,
  `input_name` varchar(64) NOT NULL,
  `input_tel` varchar(32) NOT NULL,
  `input_email` varchar(64) NOT NULL,
  `input_observation_liveIn_out_yes` varchar(255) NOT NULL,
  `input_live` varchar(16) NOT NULL,
  `input_observation_liveIn_out_no` varchar(255) NOT NULL,
  `input_number_person` int(10) NOT NULL,
  `input_meal_observation_lunch` varchar(255) NOT NULL,
  `input_meal` varchar(64) NOT NULL,
  `input_meal_observation_dinner` varchar(255) NOT NULL,
  `input_hours` int(10) NOT NULL,
  `input_waitress` varchar(16) NOT NULL,
  `input_observation_waitress_yes` varchar(255) NOT NULL,
  `input_observation_waitress_no` varchar(255) NOT NULL,
  `input_agenda` datetime NOT NULL,
  `input_comments` varchar(255) NOT NULL,
  `order_id` varchar(64) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_ip_port` varchar(32) NOT NULL,
  `orders_status_id` int(10) NOT NULL DEFAULT '1',
  `chef_service_price` decimal(10,2) NOT NULL,
  `delivery_orders_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `product_code` varchar(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `registered_in` datetime NOT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_atributes`
--

CREATE TABLE IF NOT EXISTS `products_atributes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `atributes` enum('1','2','3') NOT NULL,
  `recommended` tinyint(3) NOT NULL,
  `product_size` enum('1','2','3','4') NOT NULL,
  `wine_id` int(10) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `cupom_discount_code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_cupom_discount`
--

CREATE TABLE IF NOT EXISTS `products_cupom_discount` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cupom_discount_code` varchar(32) NOT NULL,
  `percentage` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_description`
--

CREATE TABLE IF NOT EXISTS `products_description` (
  `products_id` int(10) NOT NULL AUTO_INCREMENT,
  `language_id` int(10) NOT NULL DEFAULT '1',
  `products_name` varchar(64) NOT NULL,
  `products_description` mediumtext,
  `products_url` varchar(255) DEFAULT NULL,
  `products_viewed` int(10) DEFAULT '0',
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_wine_list`
--

CREATE TABLE IF NOT EXISTS `products_wine_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `wine_color` int(10) NOT NULL,
  `type` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `recipe_title` varchar(255) NOT NULL,
  `ingredients` mediumtext NOT NULL,
  `for_marinade` mediumtext NOT NULL,
  `for_paste` mediumtext NOT NULL,
  `for_sauce` mediumtext NOT NULL,
  `for_stirfry` mediumtext NOT NULL,
  `for_steam` mediumtext NOT NULL,
  `for_wrapping` mediumtext NOT NULL,
  `seasoning` mediumtext NOT NULL,
  `dressing` mediumtext NOT NULL,
  `garnishing` mediumtext NOT NULL,
  `accompaniment` mediumtext NOT NULL,
  `method` mediumtext NOT NULL,
  `recipe_author` varchar(255) NOT NULL,
  `recipe_contact` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale_price`
--

CREATE TABLE IF NOT EXISTS `sale_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `shipping` decimal(6,2) NOT NULL,
  `contribution` decimal(6,2) NOT NULL,
  `financial_charges` decimal(6,2) NOT NULL,
  `icms` decimal(6,2) NOT NULL,
  `other_expenses` decimal(6,2) NOT NULL,
  `comissions` decimal(6,2) NOT NULL,
  `profit` decimal(6,2) NOT NULL,
  `cost_value` decimal(6,2) NOT NULL,
  `final_price` decimal(6,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_order`
--

CREATE TABLE IF NOT EXISTS `supplier_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(32) NOT NULL,
  `order_date` datetime NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `item_type` enum('ingredient','fixed assets','current assets','services','operational expenses') NOT NULL,
  `item_categ` int(10) NOT NULL,
  `item` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `unity` enum('gramas','metros','peca','unidade','caixa') NOT NULL,
  `price_unity` decimal(10,2) NOT NULL,
  `time_delivery` varchar(55) NOT NULL,
  `payment_deadline` varchar(155) NOT NULL,
  `payment_method` varchar(55) NOT NULL,
  `user_id` int(10) NOT NULL,
  `company` int(10) NOT NULL,
  `status` enum('aberto','cancelado','finalizado') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=561 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bairros`
--

CREATE TABLE IF NOT EXISTS `tb_bairros` (
  `id` bigint(19) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `id_cidade` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='used only for brazilian companies';

-- --------------------------------------------------------

--
-- Table structure for table `tb_cidades`
--

CREATE TABLE IF NOT EXISTS `tb_cidades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado` int(10) NOT NULL DEFAULT '0',
  `uf` varchar(4) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='used only for brazilian companies' AUTO_INCREMENT=9723 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_estados`
--

CREATE TABLE IF NOT EXISTS `tb_estados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pais` int(10) NOT NULL,
  `uf` varchar(10) NOT NULL,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='used only for brazilian companies' AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paises`
--

CREATE TABLE IF NOT EXISTS `tb_paises` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(16) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='used only for brazilian companies' AUTO_INCREMENT=3 ;

