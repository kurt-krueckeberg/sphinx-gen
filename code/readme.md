# YAML file confg.yml Description

The yaml file **config.yml** captures details found in the recorded church events of baptism,
confirmation, marriage and burial in German parishes between the 17th and 19th centuries.

The organization and the keys found in the config.ymle and how they
should be interpreted and used to create MyST markdown pages follows.

## Top Level key church-records

The top level key `church-records` has these subkeys:

- `parish:` - the locality of the church parish 
- `volume-path:` - is part of the citation that will be at the bottom of
   each generated MyST markdown page. It shows the navigation path on the
   [Archion.de](https://Archion.de) website to the parish value of the
   `parish:` key 
