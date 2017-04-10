/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Administrator
 * Created: 2017-3-4
 */

CREATE TABLE t_post (
  userid int(11) PRIMARY KEY  NOT NULL AUTO_INCREMENT,
  username varchar(15) NOT NULL,
  sex char(255) NOT NULL,
  age int(11) NOT NULL,
  password varchar(50) NOT NULL,
  email varchar(50) NOT NULL COMMENT '邮箱',
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL
);

