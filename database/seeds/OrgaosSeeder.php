<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Modules\Sisadm\Repositories\OrgaoRepository;

class OrgaosSeeder extends Seeder
{
    private $orgaoRepository;

    public function __construct(OrgaoRepository $orgaoRepository)
    {
        $this->orgaoRepository = $orgaoRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(OrgaoRepository $orgaoRepository)
    {
        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "MF",
            "no_orgao" => "MINISTÉRIO DA FAZENDA",
            "id_municipio" => 755,
            "co_uorg" => "000050274",
            "co_siafi" => 000000,
            "sn_oficial" => 1,
            "nr_ordem" => 1,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "GMF",
            "no_orgao" => "GABINETE DO MINISTRO DA FAZENDA",
            "id_municipio" => 755,
            "co_uorg" => "000005534",
            "co_siafi" => 170001,
            "sn_oficial" => 1,
            "nr_ordem" => 1,
            "id_orgao_id" => 1,
        ]);        

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "RFB",
            "no_orgao" => "SECRETARIA DA RECEITA FEDERAL",
            "id_municipio" => 755,
            "co_uorg" => "000057360",
            "co_siafi" => 170010,
            "sn_oficial" => 1,
            "nr_ordem" => 2,
            "id_orgao_id" => 1,
        ]);        

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "PGFN",
            "no_orgao" => "PROCURADORIA-GERAL DA FAZENDA NACIONAL",
            "id_municipio" => 755,
            "co_uorg" => "000005636",
            "co_siafi" => 170008,
            "sn_oficial" => 1,
            "nr_ordem" => 3,
            "id_orgao_id" => 1,
        ]);        

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "STN",
            "no_orgao" => "SECRETARIA DO TESOURO NACIONAL",
            "id_municipio" => 755,
            "co_uorg" => "000005542",
            "co_siafi" => 170500,
            "sn_oficial" => 1,
            "nr_ordem" => 4,
            "id_orgao_id" => 1,
        ]);        

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "ESAF",
            "no_orgao" => "ESCOLA DE ADMINISTRACAO FAZENDARIA",
            "id_municipio" => 755,
            "co_uorg" => "000005533",
            "co_siafi" => 170009,
            "sn_oficial" => 1,
            "nr_ordem" => 5,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SE",
            "no_orgao" => "SECRETARIA EXECUTIVA DO MINISTÉRIO DA FAZENDA",
            "id_municipio" => 755,
            "co_uorg" => "000005535",
            "co_siafi" => 170311,
            "sn_oficial" => 1,
            "nr_ordem" => 6,
            "id_orgao_id" => 1,
        ]);   

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAIN",
            "no_orgao" => "SECRETARIA DE ASSUNTOS INTERNACIONAIS",
            "id_municipio" => 755,
            "co_uorg" => "000005770",
            "co_siafi" => 170191,
            "sn_oficial" => 1,
            "nr_ordem" => 7,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEAE",
            "no_orgao" => "SECRETARIA DE ACOMPANHAMENTO ECONOMICO",
            "id_municipio" => 755,
            "co_uorg" => "000005540",
            "co_siafi" => 170004,
            "sn_oficial" => 1,
            "nr_ordem" => 8,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SPE",
            "no_orgao" => "SECRETARIA DE POLITICA ECONOMICA",
            "id_municipio" => 755,
            "co_uorg" => "000005571",
            "co_siafi" => 170250,
            "sn_oficial" => 1,
            "nr_ordem" => 9,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SPREV",
            "no_orgao" => "SECRETARIA DE PREVIDENCIA",
            "id_municipio" => 755,
            "co_uorg" => "000064025",
            "co_siafi" => 170001,
            "sn_oficial" => 1,
            "nr_ordem" => 10,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COAF",
            "no_orgao" => "CONSELHO DE CONTROLE DE ATIVIDADES FINANCEIRAS",
            "id_municipio" => 755,
            "co_uorg" => "000052264",
            "co_siafi" => 170401,
            "sn_oficial" => 1,
            "nr_ordem" => 11,
            "id_orgao_id" => 1,
        ]); 
        
        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CARF",
            "no_orgao" => "CONSELHO ADMINISTRATIVO DE RECURSOS FISCAIS",
            "id_municipio" => 755,
            "co_uorg" => "000061640",
            "co_siafi" => 170001,
            "sn_oficial" => 1,
            "nr_ordem" => 12,
            "id_orgao_id" => 1,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CONFAZ",
            "no_orgao" => "CONSELHO NACIONAL DE POLITICA FAZENDARIA",
            "id_municipio" => 755,
            "co_uorg" => "000061639",
            "co_siafi" => 170001,
            "sn_oficial" => 1,
            "nr_ordem" => 13,
            "id_orgao_id" => 1,
        ]);         

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SPOA",
            "no_orgao" => "SUBSECRETARIA DE PLANEJAMENTO, ORÇAMENTO E ADMINISTRAÇÃO",
            "id_municipio" => 755,
            "co_uorg" => "000052906",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 2,
            "id_orgao_id" => 7,
        ]);        

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COGTI",
            "no_orgao" => "COORDENAÇÃO-GERAL DE TECNOLOGIA DA INFORMAÇÃO",
            "id_municipio" => 755,
            "co_uorg" => "000057236",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 1,
            "id_orgao_id" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COSIR",
            "no_orgao" => "COORDENAÇÃO DE SISTEMAS DE INFORMAÇÃO E RECURSOS TECNOLÓGICOS",
            "id_municipio" => 755,
            "co_uorg" => "000056233",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 1,
            "id_orgao_id" => 16,
        ]); 
        
        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DINES",
            "no_orgao" => "DIVISÃO DE NEGÓCIO E SISTEMAS DE INFORMAÇÃO",
            "id_municipio" => 755,
            "co_uorg" => "000056234",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 1,
            "id_orgao_id" => 17,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEPRO",
            "no_orgao" => "SERVIÇO DE PRODUÇÃO, SUPORTE E REDE",
            "id_municipio" => 755,
            "co_uorg" => "000056235",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 2,
            "id_orgao_id" => 17,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-AL",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/AL",
            "id_municipio" => 2840,
            "co_uorg" => "000061982",
            "co_siafi" => 170064,
            "sn_oficial" => 1,
            "nr_ordem" => 10,
            "id_orgao_id" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-AM",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/AM",
            "id_municipio" => 2886,
            "co_uorg" => "000062001",
            "co_siafi" => 170207,
            "sn_oficial" => 1,
            "nr_ordem" => 11,
            "id_orgao_id" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-BA",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/BA",
            "id_municipio" => 4334,
            "co_uorg" => "000061999",
            "co_siafi" => 170075,
            "sn_oficial" => 1,
            "nr_ordem" => 12,
            "id_orgao_id" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-CE",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/CE",
            "id_municipio" => 1832,
            "co_uorg" => "000061998",
            "co_siafi" => 170038,
            "sn_oficial" => 1,
            "nr_ordem" => 13,
            "id_orgao_id" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-DF",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/DF",
            "id_municipio" => 755,
            "co_uorg" => "000061981",
            "co_siafi" => 170531,
            "sn_oficial" => 1,
            "nr_ordem" => 14,
            "id_orgao_id" => 15,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-ES",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/ES",
            "id_municipio" => 5534,
            "co_uorg" => "000061983",
            "co_siafi" => 170100,
            "sn_oficial" => 1,
            "nr_ordem" => 15,
            "id_orgao_id" => 15,    
        ]);         

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-GO",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/GO",
            "id_municipio" => 1928,
            "co_uorg" => "000061987",
            "co_siafi" => 170195,
            "sn_oficial" => 1,
            "nr_ordem" => 16,
            "id_orgao_id" => 15,    
        ]);         
            
        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-MA",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/MA",
            "id_municipio" => 4812,
            "co_uorg" => "000061988",
            "co_siafi" => 170025,
            "sn_oficial" => 1,
            "nr_ordem" => 17,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-MG",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/MG",
            "id_municipio" => 593,
            "co_uorg" => "000061985",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 18,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-MS",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/MS",
            "id_municipio" => 973,
            "co_uorg" => "000061989",
            "co_siafi" => 170106,
            "sn_oficial" => 1,
            "nr_ordem" => 19,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-MT",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/MT",
            "id_municipio" => 1492,
            "co_uorg" => "000062002",
            "co_siafi" => 170190,
            "sn_oficial" => 1,
            "nr_ordem" => 20,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-PA",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/PA",
            "id_municipio" => 581,
            "co_uorg" => "000062000",
            "co_siafi" => 170214,
            "sn_oficial" => 1,
            "nr_ordem" => 21,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-PB",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/PB",
            "id_municipio" => 2596,
            "co_uorg" => "000061990",
            "co_siafi" => 170050,
            "sn_oficial" => 1,
            "nr_ordem" => 22,
            "id_orgao_id" => 15,    
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-PE",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/PE",
            "id_municipio" => 4112,
            "co_uorg" => "000061986",
            "co_siafi" => 170055,
            "sn_oficial" => 1,
            "nr_ordem" => 23,
            "id_orgao_id" => 15,    
        ]);         

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-PI",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/PI",
            "id_municipio" => 5210,
            "co_uorg" => "000061991",
            "co_siafi" => 170032,
            "sn_oficial" => 1,
            "nr_ordem" => 24,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-PR",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/PR",
            "id_municipio" => 1509,
            "co_uorg" => "000061995",
            "co_siafi" => 170153,
            "sn_oficial" => 1,
            "nr_ordem" => 25,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-RJ",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/RJ",
            "id_municipio" => 4209,
            "co_uorg" => "000061984",
            "co_siafi" => 170114,
            "sn_oficial" => 1,
            "nr_ordem" => 26,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-RN",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/RN",
            "id_municipio" => 3240,
            "co_uorg" => "000061992",
            "co_siafi" => 170045,
            "sn_oficial" => 1,
            "nr_ordem" => 27,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-RS",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/RS",
            "id_municipio" => 3948,
            "co_uorg" => "000061996",
            "co_siafi" => 170175,
            "sn_oficial" => 1,
            "nr_ordem" => 28,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-SC",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/SC",
            "id_municipio" => 1813,
            "co_uorg" => "000061993",
            "co_siafi" => 170166,
            "sn_oficial" => 1,
            "nr_ordem" => 29,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-SE",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/SE",
            "id_municipio" => 295,
            "co_uorg" => "000061994",
            "co_siafi" => 170069,
            "sn_oficial" => 1,
            "nr_ordem" => 30,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAMF-SP",
            "no_orgao" => "SUPERINTENDENCIA DE ADMINISTRACAO DO MF/SP",
            "id_municipio" => 4855,
            "co_uorg" => "000061997",
            "co_siafi" => 170131,
            "sn_oficial" => 1,
            "nr_ordem" => 31,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COGEF",
            "no_orgao" => "COORDENACAO GERAL DE ORCAMENTO, FINANCAS E ANALISE CONTABIL",
            "id_municipio" => 755,
            "co_uorg" => "000055054",
            "co_siafi" => 170001,
            "sn_oficial" => 1,
            "nr_ordem" => 2,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COGEP",
            "no_orgao" => "COORDENACAO-GERAL DE GESTAO DE PESSOAS",
            "id_municipio" => 755,
            "co_uorg" => "000062011",
            "co_siafi" => 170006,
            "sn_oficial" => 1,
            "nr_ordem" => 3,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COGRL",
            "no_orgao" => "COORDENACAO-GERAL DE RECURSOS LOGISTICOS",
            "id_municipio" => 755,
            "co_uorg" => "000052911",
            "co_siafi" => 170016,
            "sn_oficial" => 1,
            "nr_ordem" => 4,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COGPL",
            "no_orgao" => "COORDENACAO GERAL DE PLANEJAMENTO E PROJETOS ORGANIZACIONAIS",
            "id_municipio" => 755,
            "co_uorg" => "000057235",
            "co_siafi" => 170014,
            "sn_oficial" => 1,
            "nr_ordem" => 5,
            "id_orgao_id" => 15,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CEF",
            "no_orgao" => "CAIXA ECONOMICA FEDERAL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 7,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BCB",
            "no_orgao" => "BANCO CENTRAL DO BRASIL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 4,    
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BB",
            "no_orgao" => "BANCO DO BRASIL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 3, 
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SUSEP",
            "no_orgao" => "SUPERINTENDENCIA DE SEGUROS PRIVADOS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 13, 
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CVM",
            "no_orgao" => "COMISSAO DE VALORES MOBILIARIOS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 8,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CGSN",
            "no_orgao" => "CONSELHO GESTOR DO SIMPLES NACIONAL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 8,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "PREVIC",
            "no_orgao" => "SUPERINTENDENCIA NACIONAL DE PREVIDENCIA COMPLEMENTAR",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 14,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "PR",
            "no_orgao" => "PRESIDENCIA DA REPUBLICA",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 15,
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CD",
            "no_orgao" => "CÂMARA DOS DEPUTADOS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 15,
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SF",
            "no_orgao" => "SENADO FEDERAL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 15,
        
        ]);



        //ORGAOS EXCLUIDOS PARA MIGRACAO DO PARLA
        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DR. LÍSCIO",
            "no_orgao" => "DR. LÍSCIO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 2,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BASA",
            "no_orgao" => "BANCO DA AMAZONIA",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 2,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BMB",
            "no_orgao" => "BANCO DA AMAZONIA",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 2,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BNB",
            "no_orgao" => "BANCO DO NORDESTE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 5,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "BNDES",
            "no_orgao" => "BANCO NACIONAL DO DESENVOLVIMENTO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 5,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CEST",
            "no_orgao" => "CEST",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 5,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CFP",
            "no_orgao" => "CFP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 5,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CISET",
            "no_orgao" => "CISET",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 5,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CMB",
            "no_orgao" => "CASA DA MOEDA DO BRASIL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "COTEPE",
            "no_orgao" => "COMISSÃO TÉCNICA PERMANENTE DO ICMS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CMN",
            "no_orgao" => "CONSELHO MONETÁRIO NACIONAL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CRH",
            "no_orgao" => "CRH",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DAIN",
            "no_orgao" => "DAIN",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DAP",
            "no_orgao" => "DAP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DEAIN",
            "no_orgao" => "DEAIN",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DECEX",
            "no_orgao" => "DECEX",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DIC",
            "no_orgao" => "DIC",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DNPA",
            "no_orgao" => "DNPA",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DOU",
            "no_orgao" => "DOU",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DPU",
            "no_orgao" => "DPU",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DRF",
            "no_orgao" => "DRF",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DRJ",
            "no_orgao" => "DRJ",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DTN",
            "no_orgao" => "DTN",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "IBGE",
            "no_orgao" => "IBGE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "IRB",
            "no_orgao" => "INSTITUTO DE RESSEGUROS DO BRASIL",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 10,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAA",
            "no_orgao" => "SAA",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SAG",
            "no_orgao" => "SAG",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "EXTERNO",
            "no_orgao" => "EXTERNO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEPE",
            "no_orgao" => "SEPE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEPLAN",
            "no_orgao" => "SEPLAN",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SFC",
            "no_orgao" => "SFC",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SFN",
            "no_orgao" => "SFN",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SNE",
            "no_orgao" => "SNE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SNP",
            "no_orgao" => "SNP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "AVISO CCIV",
            "no_orgao" => "AVISO CCIV",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SPU",
            "no_orgao" => "SPU",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SUNAB",
            "no_orgao" => "SUNAB",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SERPRO",
            "no_orgao" => "SERVICO FEDERAL DE PROCESSAMENTO DE DADOS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 11,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CONJUR",
            "no_orgao" => "CONJUR",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "IBS",
            "no_orgao" => "IBS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "MPAS",
            "no_orgao" => "MPAS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "GM",
            "no_orgao" => "GM",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SE/COTEPE",
            "no_orgao" => "SE/COTEPE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DR.GERARDO",
            "no_orgao" => "DR.GERARDO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "AVISO PR",
            "no_orgao" => "AVISO PR",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "EMGEA",
            "no_orgao" => "EMPRESA GESTORA DE ATIVOS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 9,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "OFC/PR",
            "no_orgao" => "OFC/PR",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "PR/OFC",
            "no_orgao" => "PR/OFC",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SRP",
            "no_orgao" => "SRP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEP",
            "no_orgao" => "SEP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "OFI/AAP",
            "no_orgao" => "OFI/AAP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "OFC/SE",
            "no_orgao" => "OFC/SE",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "OFC/SF",
            "no_orgao" => "OFC/SF",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SUPAR/SRI",
            "no_orgao" => "SUPAR/SRI",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "OFI/SRI",
            "no_orgao" => "OFI/SRI",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "AVI/MF",
            "no_orgao" => "AVI/MF",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "CCP",
            "no_orgao" => "CCP",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "DR EDMUNDO",
            "no_orgao" => "DR EDMUNDO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SEREF",
            "no_orgao" => "SEREF",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 12,
            "deleted_at" => Carbon::now()            
        ]); 

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "SPPC",
            "no_orgao" => "SPPC",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "MPS",
            "no_orgao" => "MPS",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "PREVIDENCI",
            "no_orgao" => "PREVIDENCI",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);

        $this->orgaoRepository->firstOrCreate([
            "sg_orgao" => "NÃO INFORMADO",
            "no_orgao" => "NÃO INFORMADO",
            "id_municipio" => 755,
            "sn_oficial" => 0,
            "nr_ordem" => 6,
            "deleted_at" => Carbon::now()
        ]);
  
        //COMANDO RESPONSÁVEL POR POPULAR A VIEW MATERIALIZADA spoa_portal.vw_orgao_hierarquia
        DB::statement("REFRESH MATERIALIZED VIEW spoa_portal.vw_orgao_hierarquia;");
    }
}
