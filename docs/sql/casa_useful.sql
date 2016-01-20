
/*添加民宿回滚，删除所有信息*/
delete from content_attachment;
delete from content;
delete from attachment;
delete from casa_tag;
delete from casa;
delete from tag where id>12;
