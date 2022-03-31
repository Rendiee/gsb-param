INSERT INTO `utilisateur` (`u_id`, `u_nom`, `u_prenom`, `u_adresse`, `u_cp`, `u_ville`, `u_email`) VALUES
('1', 'Villechalane', 'Louis', '8 cours Lafontaine', '29000', 'BREST', 'villechalane.louis@gmail.com'),
('2', 'Andre', 'David', '1 r Aimon de Chissée', '38100', 'GRENOBLE', 'andre.david@gmail.com'),
('3', 'Bedos', 'Christian', '1 r Bénédictins', '65000', 'TARBES', 'bedos.christian@gmail.com'),
('4', 'Tusseau', 'Louis', '22 r Renou', '86000', 'POITIERS', 'tusseau.louis@gmail.com'),
('5', 'Bentot', 'Pascal', '11 av 6 Juin', '67000', 'STRASBOURG', 'bentot.pascal@gmail.com'),
('6', 'Bioret', 'Luc', '1 r Linne', '35000', 'RENNES', 'bioret.luc@gmail.com'),
('7', 'Bunisset', 'Francis', '10 r Nicolas Chorier', '85000', 'LA ROCHE SUR YON', 'bunisset.francis@gmail.com'),
('8', 'Bunisset', 'Denise', '1 r Lionne', '49100', 'ANGERS', 'bunisset.denise@gmail.com'),
('9', 'Cacheux', 'Bernard', '114 r Authie', '34000', 'MONTPELLIER', 'cacheux.bernard@gmail.com'),
('10', 'Cadic', 'Eric', '123 r Caponière', '41000', 'BLOIS', 'cadic.eric@gmail.com'),
('11', 'Charoze', 'Catherine', '100 pl Géants', '33000', 'BORDEAUX', 'charoze.catherine@gmail.com');


INSERT INTO `login` (`l_id`, `l_identifiant`, `l_motdepasse`, `u_id`) VALUES
(1, 'villou', '6cf17e0501b8078722f316f094e230341b4f1b2d4d14cc082c41494d6b462024f031beff6fc25145ed02a58181fc90a7fca58f0d879b349638df19dca85efa7f', '1'),
(2, 'anddav', 'ff781e873746adf59e3165b217034477ca29d4f2322720e05492ea90d21010378252a85f2d66025874647c6d162d45df2766e8003f33c885bbc3c4dbbe92141f', '2'),
(3, 'bedchr', 'dbb65dd51a8348771883fae9cd7cc40ce1cf33e3756b4ca798bfcdcc37499b7e7236af7bd16d469bdaf8b039f3d5f414cb8a840d3675862675c0dc4a18fb5946', '3'),
(4, 'tuslou', 'd0f2a12b1928e2a54043a3e360b2f9ed7df27b780f668b066ed9de61e0007898a07ff05fbf2f062348d55cb4bf824c8c96e9102050271204713f228034ce709c', '4'),
(5, 'benpas', '9a07a357cc916422bf1c22ad26a1fbf87298ca0842531b1bf39f42802885e1006b3f1f0f94d7fe3722bd13dce1924c43d85ff310216a1c1b9494ebc0920af5ae', '5'),
(6, 'bioluc', '339ba91f5fb96b88de6e708ec7d474da3bacca9d716ddde2b1a6f823b69a0673b68b4b1befa8d0166719e75d2b215f710b40ee846b023f515d5248c369a4c123', '6'),
(7, 'bunfra', '969e3a1370ee3cfd2ad66a4625d234d35d394fd7a41a17d5c9990ad7682fbac7f7fb48c1294792d48d9e4e1f8d62a44cf47de23a5de07997d91051fed2355df3', '7'),
(8, 'bunden', '63b1fc033109ff454b5f206d694331ea9ff59d063bb82f1814c1cda1c0e39b846e59a2c14bc0059f0c7209703017e6c95e4eaf5a76a2bc65b62aa23d232e2473', '8'),
(9, 'cacber', 'cf83dbc8c8342dbcc14d5f8bdf9fb1d553e63a123f8ca0b66712e82aaddd35cb62c1a82545bb7f791c5d038fc0563a641f0f53cde79428991f521f136bdc0cdc', '9'),
(10, 'caderi', '91aab2882ec9ecc6d99d4f54c79e62bca477aed8e581744a82903c93404a5c64fa5214bab11cc646d4414eda1ba9f2b4bf30f37eb858cd576f184c92edc0e543', '10'),
(11, 'chacat', '76c0ddffa104f6dd5ecea921b6f8eeea52ea6e97d42c9643cee29cc21ecbf91ccfc7ec1e10a0cbacf5c3c3cd79f99edf860c55333889aa9dffc1a615b421821d', '11');