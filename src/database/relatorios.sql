select
  *,
  "pessoas".*
from
  "carros"
  inner join "pessoas" on "carros"."pessoa_id" = "pessoas"."id"
group by
  carros.id,
  pessoas.id
order by
  pessoas.nome asc


  