//Si al momento de hacer la compra el cliente no tiene un metodo de pago, saldra un pop up(modal) que pida su metodo de pago, si ya tiene un metodo de pago registrado, entonces creara un pago que lo enlazara a esa compra como llave foranea

INSERT INTO `purchases` (`id`, `paymentdate`, `status`, `finishdate`, `id_payment`, `id_developer`, `id_product`, `id_seller`, `id_client`) VALUES (NULL, '15/23/2203 ', 'Todo', NULL, '1', NULL, '1468', NULL, '2')



INSERT INTO `payments` (`id`, `valuepaid`, `halfpayment`, `accreditationdate`) VALUES (NULL, '10000', 'transferencia banncaria', NULL)

SELECT * FROM `clients` WHERE `id_user` = 5
