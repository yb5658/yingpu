
drop table if exists `jfsd_system_jiaocai`;
create table if not exists `jfsd_system_jiaocai` (
    `id` int unsigned not null auto_increment comment '教材id',
    `name` varchar(100) not null default '' comment '学科',
    `version` smallint unsigned not null default 0 comment '教材版本',
    `ctime` int unsigned not null default 0 comment '创建时间',
    `utime` int unsigned not null default 0 comment '修改时间',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`)
) engine innodb charset utf8 comment '教务系统-教材版本';

drop table if exists `jfsd_system_scholl`;
create table if not exists `jfsd_system_scholl` (
    `id` smallint unsigned not null auto_increment comment '小区id',
    `name` varchar(100) not null default '' comment '校区名称',
    `tel` varchar(25) not null default '' comment '校区电话',
    `address` varchar(255) not null default '' comment '校区地址',
    `ctime` int unsigned not null default 0 comment '创建时间',
    `utime` int unsigned not null default 0 comment '修改时间',
    `etime` int unsigned not null default 0 comment '到期时间',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`)
) engine innodb charset utf8 comment '教务系统-校区';

drop table if exists `jfsd_system_user`;
create table if not exists `jfsd_system_user` (
    `id` int unsigned not null auto_increment comment '管理员id',
    `sid` smallint unsigned not null default 0 comment '校区id',
    `user` varchar(20) not null default '' comment '用户名',
    `mobile` varchar(20) not null default '' comment '手机号',
    `pass` varchar(32) not null default '' comment '登录密码',
    `group_id` int unsigned not null default 0 comment '角色分组',
    `sex` tinyint not null default 0 comment '性别',
    `wechat` varchar(50) not null default '' comment '微信号',
    `avatar` varchar(255) not null default '' comment '头像',
    `number` varchar(50) not null default '' comment '编号',
    `xueke` varchar(999) not null default '' comment '学科',
    `alleow_print` tinyint not null default 0 comment '讲义打印',
    `ctime` int unsigned not null default 0 comment '创建时间',
    `utime` int unsigned not null default 0 comment '修改时间',
    `login` int unsigned not null default 0 comment '登录次数',
    `last_login_time` int unsigned not null default 0 comment '上次登陆时间',
    `last_login_ip` int unsigned not null default 0 comment '上次登陆ip',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`),
    index (`sid`),
    unique (`user`)
) engine innodb charset utf8 comment '教务系统-校长+理员+老师';


drop table if exists `jfsd_system_class`;
create table if not exists `jfsd_system_class` (
    `id` int unsigned not null auto_increment comment '班级id',
    `sid` smallint unsigned not null default 0 comment '所在校区',
    `uid` int unsigned not null default 0 comment '任课老师',
    `level` int unsigned not null default 0 comment '年级/科目',
    `name` varchar(100) not null default '' comment '班级名称',
    `number` varchar(100) not null default '' comment '编号编号',
    `lesson_num` smallint unsigned not null default 0 comment '课节数',
    `student_num` smallint unsigned not null default 0 comment '学员数',
    `banxing` varchar(100) not null default '' comment '班型',
    `stime` int unsigned not null default 0 comment '开始时间',
    `etime` int unsigned not null default 0 comment '结束时间',
    `ttime` text comment '授课时间',
    `ctime` int unsigned not null default 0 comment '创建时间',
    `utime` int unsigned not null default 0 comment '修改时间',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`),
    index (`sid`),
    index (`uid`)
) engine innodb charset utf8 comment '教务系统-班级';

drop table if exists `jfsd_system_student`;
create table if not exists `jfsd_system_student` (
    `id` int unsigned not null auto_increment comment '学员id',
    `sid` smallint unsigned not null default 0 comment '所在学校',
    `name` varchar(20) not null default '' comment '学员名称',
    `avatar` varchar(255) not null default '' comment '学员头像',
    `number` varchar(50) not null default '' comment '学员编号',
    `jiazhang` varchar(999) not null default '' comment '家长',
    `banji` varchar(255) not null default '' comment '班级',
    `yuanxuehao` varchar(50) not null default '' comment '原学号',
    `sex` tinyint not null default 0 comment '性别',
    `birthday` date not null comment '出生年月',
    `level` tinyint unsigned not null default 0 comment '在校年级',
    `lesson_num` smallint unsigned not null default 0 comment '课节数',
    `ctime` int unsigned not null default 0 comment '创建时间',
    `utime` int unsigned not null default 0 comment '修改时间',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`),
    index (`sid`)
) engine innodb charset utf8 comment '教务系统-学员表';

drop table if exists `jfsd_system_class_student`;
create table if not exists `jfsd_system_class_student` (
    `class_id` int unsigned not null default 0 comment '班级id',
    `student_id` int unsigned not null default 0 comment '学员id',
    primary key (`class_id`, `student_id`)
) engine innodb charset utf8 comment '教务系统-班级关联学生';

drop table if exists `jfsd_system_class_teach`;
create table if not exists `jfsd_system_class_teach` (
    `id` int unsigned not null auto_increment comment '授课id',
    `uid` int unsigned not null default 0 comment '任课老师',
    `class_id` int unsigned not null default 0 comment '班级id',
    `stime` int unsigned not null default 0 comment '开始时间',
    `etime` int unsigned not null default 0 comment '结束时间',
    `sign_time` int unsigned not null default 0 comment '签到时间',
    `sort` tinyint not null default 0 comment '排序',
    `status` tinyint not null default 0 comment '状态',
    primary key (`id`),
    index (`uid`),
    index (`class_id`)
) engine innodb charset utf8 comment '教务系统-授课记录 老师考勤签到';
