CREATE TABLE kmmAccounts (id varchar(32) NOT NULL, institutionId varchar(32), parentId varchar(32), lastReconciled datetime, lastModified datetime, openingDate date, accountNumber mediumtext, accountType varchar(16) NOT NULL, accountTypeString mediumtext, isStockAccount char(1), accountName mediumtext, description mediumtext, currencyId varchar(32), balance mediumtext, balanceFormatted mediumtext, transactionCount bigint unsigned, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmBudgetConfig (id varchar(32) NOT NULL, name text NOT NULL, start date NOT NULL, XML longtext, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmCurrencies (ISOcode char(3) NOT NULL, name text NOT NULL, type smallint unsigned, typeString mediumtext, symbol1 smallint unsigned, symbol2 smallint unsigned, symbol3 smallint unsigned, symbolString varchar(255), partsPerUnit varchar(24), smallestCashFraction varchar(24), smallestAccountFraction varchar(24), PRIMARY KEY (ISOcode)) ENGINE = InnoDB;

CREATE TABLE kmmFileInfo (version varchar(16), created date, lastModified date, baseCurrency char(3), institutions bigint unsigned, accounts bigint unsigned, payees bigint unsigned, transactions bigint unsigned, splits bigint unsigned, securities bigint unsigned, prices bigint unsigned, currencies bigint unsigned, schedules bigint unsigned, reports bigint unsigned, kvps bigint unsigned, dateRangeStart date, dateRangeEnd date, hiInstitutionId bigint unsigned, hiPayeeId bigint unsigned, hiAccountId bigint unsigned, hiTransactionId bigint unsigned, hiScheduleId bigint unsigned, hiSecurityId bigint unsigned, hiReportId bigint unsigned, encryptData varchar(255), updateInProgress char(1), budgets bigint unsigned, hiBudgetId bigint unsigned, logonUser varchar(255), logonAt datetime, fixLevel int unsigned) ENGINE = InnoDB;

CREATE TABLE kmmInstitutions (id varchar(32) NOT NULL, name text NOT NULL, manager mediumtext, routingCode mediumtext, addressStreet mediumtext, addressCity mediumtext, addressZipcode mediumtext, telephone mediumtext, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmKeyValuePairs (kvpType varchar(16) NOT NULL, kvpId varchar(32), kvpKey varchar(255) NOT NULL, kvpData mediumtext) ENGINE = InnoDB;
CREATE INDEX kmmKeyValuePairs_type_id_idx ON kmmKeyValuePairs (kvpType,kvpId);

CREATE TABLE kmmPayees (id varchar(32) NOT NULL, name mediumtext, reference mediumtext, email mediumtext, addressStreet mediumtext, addressCity mediumtext, addressZipcode mediumtext, addressState mediumtext, telephone mediumtext, notes longtext, defaultAccountId varchar(32), matchData tinyint unsigned, matchIgnoreCase char(1), matchKeys mediumtext, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmPrices (fromId varchar(32) NOT NULL, toId varchar(32) NOT NULL, priceDate date NOT NULL, price text NOT NULL, priceFormatted mediumtext, priceSource mediumtext, PRIMARY KEY (fromId, toId, priceDate)) ENGINE = InnoDB;

CREATE TABLE kmmReportConfig (name varchar(255) NOT NULL, XML longtext, id varchar(32) NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmSchedulePaymentHistory (schedId varchar(32) NOT NULL, payDate date NOT NULL, PRIMARY KEY (schedId, payDate)) ENGINE = InnoDB;

CREATE TABLE kmmSchedules (id varchar(32) NOT NULL, name text NOT NULL, type tinyint unsigned NOT NULL, typeString mediumtext, occurence smallint unsigned NOT NULL, occurenceMultiplier smallint unsigned NOT NULL, occurenceString mediumtext, paymentType tinyint unsigned, paymentTypeString longtext, startDate date NOT NULL, endDate date, fixed char(1) NOT NULL, autoEnter char(1) NOT NULL, lastPayment date, nextPaymentDue date, weekendOption tinyint unsigned NOT NULL, weekendOptionString mediumtext, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmSecurities (id varchar(32) NOT NULL, name text NOT NULL, symbol mediumtext, type smallint unsigned NOT NULL, typeString mediumtext, smallestAccountFraction varchar(24), tradingMarket mediumtext, tradingCurrency char(3), PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE kmmSplits (transactionId varchar(32) NOT NULL, txType char(1), splitId smallint unsigned NOT NULL, payeeId varchar(32), reconcileDate datetime, action varchar(16), reconcileFlag char(1), value text NOT NULL, valueFormatted text, shares text NOT NULL, sharesFormatted mediumtext, price text, priceFormatted mediumtext, memo mediumtext, accountId varchar(32) NOT NULL, checkNumber varchar(32), postDate datetime, bankId mediumtext, PRIMARY KEY (transactionId, splitId)) ENGINE = InnoDB;
CREATE INDEX kmmSplits_kmmSplitsaccount_type_idx ON kmmSplits (accountId,txType);

CREATE TABLE kmmTransactions (id varchar(32) NOT NULL, txType char(1), postDate datetime, memo mediumtext, entryDate datetime, currencyId char(3), bankId mediumtext, PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE VIEW kmmBalances AS SELECT kmmAccounts.id AS id, kmmAccounts.currencyId, kmmSplits.txType, kmmSplits.value, kmmSplits.shares, kmmSplits.postDate AS balDate, kmmTransactions.currencyId AS txCurrencyId FROM kmmAccounts, kmmSplits, kmmTransactions WHERE kmmSplits.txType = 'N' AND kmmSplits.accountId = kmmAccounts.id AND kmmSplits.transactionId = kmmTransactions.id;

INSERT INTO kmmFileInfo (version, created, lastModified, baseCurrency, institutions, accounts, payees, transactions, splits, securities, prices, currencies, schedules, reports, kvps, dateRangeStart, dateRangeEnd, hiInstitutionId, hiPayeeId, hiAccountId, hiTransactionId, hiScheduleId, hiSecurityId, hiReportId, encryptData, updateInProgress, budgets, hiBudgetId, logonUser, logonAt, fixLevel) VALUES (6, 2012-07-15, 2012-07-15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, 2);

INSERT INTO kmmAccounts (id, institutionId, parentId, lastReconciled, lastModified, openingDate, accountNumber, accountType, accountTypeString, isStockAccount, accountName, description, currencyId, balance, balanceFormatted, transactionCount) VALUES ('AStd::Asset', NULL, NULL, NULL, NULL, NULL, NULL, 9, 'Asset', 'N', 'Asset', NULL, NULL, NULL, NULL, NULL);

INSERT INTO kmmAccounts (id, institutionId, parentId, lastReconciled, lastModified, openingDate, accountNumber, accountType, accountTypeString, isStockAccount, accountName, description, currencyId, balance, balanceFormatted, transactionCount) VALUES ('AStd::Equity', NULL, NULL, NULL, NULL, NULL, NULL, 16, 'Equity', 'N', 'Equity', NULL, NULL, NULL, NULL, NULL);

INSERT INTO kmmAccounts (id, institutionId, parentId, lastReconciled, lastModified, openingDate, accountNumber, accountType, accountTypeString, isStockAccount, accountName, description, currencyId, balance, balanceFormatted, transactionCount) VALUES ('AStd::Expense', NULL, NULL, NULL, NULL, NULL, NULL, 13, 'Expense', 'N', 'Expense', NULL, NULL, NULL, NULL, NULL);

INSERT INTO kmmAccounts (id, institutionId, parentId, lastReconciled, lastModified, openingDate, accountNumber, accountType, accountTypeString, isStockAccount, accountName, description, currencyId, balance, balanceFormatted, transactionCount) VALUES ('AStd::Income', NULL, NULL, NULL, NULL, NULL, NULL, 12, 'Income', 'N', 'Income', NULL, NULL, NULL, NULL, NULL);

INSERT INTO kmmAccounts (id, institutionId, parentId, lastReconciled, lastModified, openingDate, accountNumber, accountType, accountTypeString, isStockAccount, accountName, description, currencyId, balance, balanceFormatted, transactionCount) VALUES ('AStd::Liability', NULL, NULL, NULL, NULL, NULL, NULL, 10, 'Liability', 'N', 'Liability', NULL, NULL, NULL, NULL, NULL);

