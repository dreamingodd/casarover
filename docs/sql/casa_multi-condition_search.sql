select casa.*
  from casa, tag, casa_tag,
       (select casa.id casa_id
          from casa, tag, casa_tag
         where tag.id = casa_tag.tag_id
           and casa.id = casa_tag.casa_id
           and tag.id in (1)
       ) casa1
 where tag.id = casa_tag.tag_id
   and casa.id = casa_tag.casa_id
   and tag.id in (3,4,5)
   and casa.id = casa1.casa_id
 group by casa.id
;

select distinct(casa.id)
  from casa, tag, casa_tag
 where tag.id = casa_tag.tag_id
   and casa.id = casa_tag.casa_id
   and tag.id in ()
   and casa.area_id in ()
;

select casa.* from casa, tag, casa_tag, area_dictionary area
 where tag.id = casa_tag.tag_id
 and casa.id = casa_tag.casa_id
 and casa.dictionary_id = area.id
 and area.parentid = 2
 group by casa.id