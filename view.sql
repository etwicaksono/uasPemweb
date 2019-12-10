-- untuk membuat v_pemasukan
CREATE VIEW v_incomes AS
SELECT 
i.id,
i.assets id_a_asset,
a.asset assets,
i.i_accounts id_i_account,
ia.kode i_kode,
ia.account i_account,
i.total,
i.info,
i.created_at,
i.updated_at,
(SELECT DATE_FORMAT(i.date,'%d/%m/%Y')) 'date'
FROM incomes i, a_accounts a, i_accounts ia
WHERE i.i_accounts = ia.id
AND i.assets = a.id