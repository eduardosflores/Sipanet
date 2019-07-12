--
-- PostgreSQL database dump
--

-- Started on 2013-04-02 13:05:15 BRT

SET statement_timeout = 0;
SET client_encoding = 'LATIN1';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- TOC entry 140 (class 1259 OID 30111)
-- Dependencies: 5
-- Name: arquivamentos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE arquivamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 140
-- Name: arquivamentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('arquivamentos_id_seq', 1, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 141 (class 1259 OID 30113)
-- Dependencies: 1947 1948 5
-- Name: arquivamentos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE arquivamentos (
    id integer DEFAULT nextval('arquivamentos_id_seq'::regclass) NOT NULL,
    processo_id integer NOT NULL,
    setor_id integer NOT NULL,
    motivo text NOT NULL,
    data timestamp without time zone DEFAULT now() NOT NULL,
    data_desarquivamento timestamp without time zone,
    motivo_desarquivamento text
);


--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 141
-- Name: TABLE arquivamentos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE arquivamentos IS 'Guarda historico de arquivamentos dos processos';


--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 141
-- Name: COLUMN arquivamentos.setor_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN arquivamentos.setor_id IS 'Setor onde o processo foi arquivado';


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 141
-- Name: COLUMN arquivamentos.motivo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN arquivamentos.motivo IS 'Motivo ou observacoes a respeito do arquivamento.';


--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 141
-- Name: COLUMN arquivamentos.data_desarquivamento; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN arquivamentos.data_desarquivamento IS 'Data em que o processo foi desarquivado.';


--
-- TOC entry 2131 (class 0 OID 0)
-- Dependencies: 141
-- Name: COLUMN arquivamentos.motivo_desarquivamento; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN arquivamentos.motivo_desarquivamento IS 'Motivo do desarquivamento.';


--
-- TOC entry 142 (class 1259 OID 30121)
-- Dependencies: 5
-- Name: assuntos_mensagem_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE assuntos_mensagem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2132 (class 0 OID 0)
-- Dependencies: 142
-- Name: assuntos_mensagem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('assuntos_mensagem_id_seq', 4, true);


--
-- TOC entry 143 (class 1259 OID 30123)
-- Dependencies: 1949 5
-- Name: assuntos_mensagem; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE assuntos_mensagem (
    id integer DEFAULT nextval('assuntos_mensagem_id_seq'::regclass) NOT NULL,
    descricao character varying(150) NOT NULL
);


--
-- TOC entry 2133 (class 0 OID 0)
-- Dependencies: 143
-- Name: TABLE assuntos_mensagem; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE assuntos_mensagem IS 'Assuntos da mensagem';


--
-- TOC entry 144 (class 1259 OID 30127)
-- Dependencies: 5
-- Name: cargos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2134 (class 0 OID 0)
-- Dependencies: 144
-- Name: cargos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('cargos_id_seq', 6, true);


--
-- TOC entry 145 (class 1259 OID 30129)
-- Dependencies: 1950 5
-- Name: cargos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE cargos (
    id integer DEFAULT nextval('cargos_id_seq'::regclass) NOT NULL,
    descricao character varying(200) NOT NULL
);


--
-- TOC entry 2135 (class 0 OID 0)
-- Dependencies: 145
-- Name: TABLE cargos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE cargos IS 'Cargos do funcionario';


--
-- TOC entry 146 (class 1259 OID 30133)
-- Dependencies: 5
-- Name: dias_na_mesa_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE dias_na_mesa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2136 (class 0 OID 0)
-- Dependencies: 146
-- Name: dias_na_mesa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('dias_na_mesa_id_seq', 44, true);


--
-- TOC entry 147 (class 1259 OID 30135)
-- Dependencies: 1951 5
-- Name: dias_na_mesa; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE dias_na_mesa (
    id integer DEFAULT nextval('dias_na_mesa_id_seq'::regclass) NOT NULL,
    setor_id integer NOT NULL,
    tipo_processo_id integer NOT NULL,
    max_dias_na_mesa integer NOT NULL
);


--
-- TOC entry 148 (class 1259 OID 30139)
-- Dependencies: 5
-- Name: divisoes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE divisoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2137 (class 0 OID 0)
-- Dependencies: 148
-- Name: divisoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('divisoes_id_seq', 13957, true);


--
-- TOC entry 149 (class 1259 OID 30141)
-- Dependencies: 1952 5
-- Name: divisoes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE divisoes (
    id integer DEFAULT nextval('divisoes_id_seq'::regclass) NOT NULL,
    processo_id integer NOT NULL,
    servidor_id integer NOT NULL
);


--
-- TOC entry 2138 (class 0 OID 0)
-- Dependencies: 149
-- Name: TABLE divisoes; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE divisoes IS 'O processo pode ser dividido para varios servidores';


--
-- TOC entry 150 (class 1259 OID 30145)
-- Dependencies: 5
-- Name: emails_suporte_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE emails_suporte_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2139 (class 0 OID 0)
-- Dependencies: 150
-- Name: emails_suporte_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('emails_suporte_id_seq', 2, true);


--
-- TOC entry 151 (class 1259 OID 30147)
-- Dependencies: 1953 5
-- Name: emails_suporte; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE emails_suporte (
    id integer DEFAULT nextval('emails_suporte_id_seq'::regclass) NOT NULL,
    descricao character varying(150) NOT NULL,
    email character varying(100) NOT NULL
);


--
-- TOC entry 2140 (class 0 OID 0)
-- Dependencies: 151
-- Name: TABLE emails_suporte; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE emails_suporte IS 'Endere�os de email do suporte - as mensagens dever�o ser enviadas para todos os e-mails cadastrados';


--
-- TOC entry 152 (class 1259 OID 30151)
-- Dependencies: 5
-- Name: etiquetas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE etiquetas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2141 (class 0 OID 0)
-- Dependencies: 152
-- Name: etiquetas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('etiquetas_id_seq', 1, true);


--
-- TOC entry 153 (class 1259 OID 30153)
-- Dependencies: 1954 5
-- Name: etiquetas; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE etiquetas (
    id integer DEFAULT nextval('etiquetas_id_seq'::regclass) NOT NULL,
    descricao character varying(100) NOT NULL,
    linhas smallint NOT NULL,
    margem_esquerda numeric(5,2) NOT NULL,
    margem_superior numeric(5,2) NOT NULL,
    largura numeric(6,2) NOT NULL,
    altura numeric(6,2) NOT NULL,
    margem_entre_etiquetas numeric(5,2) NOT NULL,
    altura_texto numeric(5,2) NOT NULL,
    margem_seguranca_lateral numeric(5,2) NOT NULL,
    margem_seguranca_superior numeric(5,2) NOT NULL
);


--
-- TOC entry 2142 (class 0 OID 0)
-- Dependencies: 153
-- Name: TABLE etiquetas; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE etiquetas IS 'Configura��es de etiquetas dispon�veis';


--
-- TOC entry 154 (class 1259 OID 30157)
-- Dependencies: 5
-- Name: grupos_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE grupos_usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2143 (class 0 OID 0)
-- Dependencies: 154
-- Name: grupos_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('grupos_usuario_id_seq', 8, true);


--
-- TOC entry 155 (class 1259 OID 30159)
-- Dependencies: 1955 5
-- Name: grupos_usuario; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE grupos_usuario (
    id integer DEFAULT nextval('grupos_usuario_id_seq'::regclass) NOT NULL,
    descricao character varying(100) NOT NULL
);


--
-- TOC entry 2144 (class 0 OID 0)
-- Dependencies: 155
-- Name: TABLE grupos_usuario; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE grupos_usuario IS 'Grupos de usuario para definicao de permissoes';


--
-- TOC entry 156 (class 1259 OID 30163)
-- Dependencies: 5
-- Name: historico_devolucoes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE historico_devolucoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 156
-- Name: historico_devolucoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('historico_devolucoes_id_seq', 1, true);


--
-- TOC entry 157 (class 1259 OID 30165)
-- Dependencies: 1956 5
-- Name: historico_devolucoes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE historico_devolucoes (
    id integer DEFAULT nextval('historico_devolucoes_id_seq'::regclass) NOT NULL,
    data_devolucao timestamp without time zone NOT NULL,
    processo_id integer NOT NULL,
    servidor_id integer NOT NULL,
    tipo_devolucao character varying(50),
    ano_doc character varying(20),
    num_doc character varying(20)
);


--
-- TOC entry 158 (class 1259 OID 30169)
-- Dependencies: 5
-- Name: historico_divisoes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE historico_divisoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 158
-- Name: historico_divisoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('historico_divisoes_id_seq', 1, true);


--
-- TOC entry 159 (class 1259 OID 30171)
-- Dependencies: 1957 5
-- Name: historico_divisoes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE historico_divisoes (
    id integer DEFAULT nextval('historico_divisoes_id_seq'::regclass) NOT NULL,
    data_divisao timestamp without time zone NOT NULL,
    processo_id integer NOT NULL,
    servidor_id integer NOT NULL
);


--
-- TOC entry 160 (class 1259 OID 30175)
-- Dependencies: 5
-- Name: interessados_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE interessados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 160
-- Name: interessados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('interessados_id_seq', 1, true);


--
-- TOC entry 161 (class 1259 OID 30177)
-- Dependencies: 1958 5
-- Name: interessados; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE interessados (
    id integer DEFAULT nextval('interessados_id_seq'::regclass) NOT NULL,
    tipo_interessado_id integer NOT NULL,
    nome character varying(150) NOT NULL,
    cpf_cnpj character varying(18),
    matricula character varying(50)
);


--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 161
-- Name: TABLE interessados; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE interessados IS 'Cadastro de interessados';


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 161
-- Name: COLUMN interessados.cpf_cnpj; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN interessados.cpf_cnpj IS 'CPF ou CNPJ do interessado';


--
-- TOC entry 198 (class 1259 OID 30646)
-- Dependencies: 1993 5
-- Name: logs; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE logs (
    id bigint NOT NULL,
    acao character varying(100) NOT NULL,
    servidor_id integer NOT NULL,
    entidade character varying(200) NOT NULL,
    objeto_id bigint,
    objeto_original text,
    objeto_modificado text,
    criacao timestamp without time zone DEFAULT now() NOT NULL
);


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE logs; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE logs IS 'Guarda historico das principais acoes dos servidores no sistema para auditoria';


--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.acao; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.acao IS 'Acao efetuada (Login, Cadastro, Atualizacao)';


--
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.servidor_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.servidor_id IS 'Servidor que efetuou a acao';


--
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.objeto_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.objeto_id IS 'PK do objeto que sofreu a acao';


--
-- TOC entry 2154 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.objeto_original; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.objeto_original IS 'Objeto serializado antes da acao';


--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.objeto_modificado; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.objeto_modificado IS 'Objeto serializado apos a acao';


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN logs.criacao; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN logs.criacao IS 'Data e hora de criacao da acao, adicionado automaticamente';


--
-- TOC entry 197 (class 1259 OID 30644)
-- Dependencies: 5 198
-- Name: logs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 197
-- Name: logs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE logs_id_seq OWNED BY logs.id;


--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 197
-- Name: logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('logs_id_seq', 1, true);


--
-- TOC entry 162 (class 1259 OID 30181)
-- Dependencies: 5
-- Name: mensagens_suporte_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE mensagens_suporte_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 162
-- Name: mensagens_suporte_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('mensagens_suporte_id_seq', 1, true);


--
-- TOC entry 163 (class 1259 OID 30183)
-- Dependencies: 1959 1960 5
-- Name: mensagens_suporte; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE mensagens_suporte (
    id bigint DEFAULT nextval('mensagens_suporte_id_seq'::regclass) NOT NULL,
    assunto_mensagem_id integer NOT NULL,
    tipo_mensagem_id integer NOT NULL,
    nome character varying(100) NOT NULL,
    orgao_id integer NOT NULL,
    telefone character varying(15) NOT NULL,
    email character varying(100) NOT NULL,
    mensagem text NOT NULL,
    data_cadastro date NOT NULL,
    resolvido boolean DEFAULT false NOT NULL
);


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 163
-- Name: TABLE mensagens_suporte; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE mensagens_suporte IS 'Mensagens enviadas para o suporte t�cnico';


--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 163
-- Name: COLUMN mensagens_suporte.data_cadastro; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN mensagens_suporte.data_cadastro IS 'now()';


--
-- TOC entry 164 (class 1259 OID 30191)
-- Dependencies: 5
-- Name: modulos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE modulos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 164
-- Name: modulos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('modulos_id_seq', 21, true);


--
-- TOC entry 165 (class 1259 OID 30193)
-- Dependencies: 1961 5
-- Name: modulos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE modulos (
    id integer DEFAULT nextval('modulos_id_seq'::regclass) NOT NULL,
    descricao character varying(100) NOT NULL
);


--
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 165
-- Name: TABLE modulos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE modulos IS 'Modulos do sistema';


--
-- TOC entry 166 (class 1259 OID 30197)
-- Dependencies: 5
-- Name: naturezas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE naturezas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 166
-- Name: naturezas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('naturezas_id_seq', 511058, true);


--
-- TOC entry 167 (class 1259 OID 30199)
-- Dependencies: 1962 1963 5
-- Name: naturezas; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE naturezas (
    id integer DEFAULT nextval('naturezas_id_seq'::regclass) NOT NULL,
    descricao character varying(200) NOT NULL,
    ativo boolean DEFAULT true NOT NULL
);


--
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 167
-- Name: TABLE naturezas; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE naturezas IS 'Cadastro das possiveis naturezas do processo';


--
-- TOC entry 168 (class 1259 OID 30204)
-- Dependencies: 5
-- Name: orgaos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE orgaos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 168
-- Name: orgaos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('orgaos_id_seq', 2, true);


--
-- TOC entry 169 (class 1259 OID 30206)
-- Dependencies: 1964 1965 1966 5
-- Name: orgaos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE orgaos (
    id integer DEFAULT nextval('orgaos_id_seq'::regclass) NOT NULL,
    codigo character varying(100),
    descricao character varying(200),
    sigla character varying(100),
    ativo boolean DEFAULT true NOT NULL,
    externo boolean DEFAULT false NOT NULL,
    codigo_antigo character varying(100)
);


--
-- TOC entry 2167 (class 0 OID 0)
-- Dependencies: 169
-- Name: TABLE orgaos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE orgaos IS 'Orgaos publicos do estado';


--
-- TOC entry 2168 (class 0 OID 0)
-- Dependencies: 169
-- Name: COLUMN orgaos.codigo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgaos.codigo IS 'Codigo do orgao no cadastro estadual';


--
-- TOC entry 2169 (class 0 OID 0)
-- Dependencies: 169
-- Name: COLUMN orgaos.sigla; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgaos.sigla IS 'Sigla ou mnemonico do orgao';


--
-- TOC entry 2170 (class 0 OID 0)
-- Dependencies: 169
-- Name: COLUMN orgaos.ativo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgaos.ativo IS 'Se o orgao esta ativo ou nao';


--
-- TOC entry 2171 (class 0 OID 0)
-- Dependencies: 169
-- Name: COLUMN orgaos.codigo_antigo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgaos.codigo_antigo IS 'C�digo do �rg�o no sistema do SGP';


--
-- TOC entry 170 (class 1259 OID 30212)
-- Dependencies: 5
-- Name: paralisacoes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE paralisacoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 170
-- Name: paralisacoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('paralisacoes_id_seq', 1, true);


--
-- TOC entry 171 (class 1259 OID 30214)
-- Dependencies: 1967 1968 5
-- Name: paralisacoes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE paralisacoes (
    id integer DEFAULT nextval('paralisacoes_id_seq'::regclass) NOT NULL,
    processo_id integer NOT NULL,
    motivo text NOT NULL,
    data timestamp without time zone DEFAULT now() NOT NULL,
    setor_id integer NOT NULL,
    servidor_id integer,
    data_liberacao timestamp without time zone
);


--
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 171
-- Name: TABLE paralisacoes; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE paralisacoes IS 'Paralisacoes sofridas pelos processos. Serve para guardar o historico e obter informacoes no futuro.';


--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 171
-- Name: COLUMN paralisacoes.motivo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN paralisacoes.motivo IS 'Motivo ou observacoes a respeito da paralisacao.';


--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 171
-- Name: COLUMN paralisacoes.setor_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN paralisacoes.setor_id IS 'Setor onde o processo foi paralisado';


--
-- TOC entry 172 (class 1259 OID 30222)
-- Dependencies: 5
-- Name: permissoes_grupo_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE permissoes_grupo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 172
-- Name: permissoes_grupo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('permissoes_grupo_id_seq', 70, true);


--
-- TOC entry 173 (class 1259 OID 30224)
-- Dependencies: 1969 5
-- Name: permissoes_grupo; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE permissoes_grupo (
    id integer DEFAULT nextval('permissoes_grupo_id_seq'::regclass) NOT NULL,
    modulo_id integer NOT NULL,
    grupo_usuario_id integer NOT NULL
);


--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 173
-- Name: TABLE permissoes_grupo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE permissoes_grupo IS 'Permissoes do grupo de usuario';


--
-- TOC entry 174 (class 1259 OID 30228)
-- Dependencies: 5
-- Name: permissoes_servidor_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE permissoes_servidor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 174
-- Name: permissoes_servidor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('permissoes_servidor_id_seq', 1, true);


--
-- TOC entry 175 (class 1259 OID 30230)
-- Dependencies: 1970 5
-- Name: permissoes_servidor; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE permissoes_servidor (
    id integer DEFAULT nextval('permissoes_servidor_id_seq'::regclass) NOT NULL,
    modulo_id integer NOT NULL,
    servidor_id integer NOT NULL
);


--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 175
-- Name: TABLE permissoes_servidor; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE permissoes_servidor IS 'Permissoes que o servidor possui, independente do grupo de usuario ao qual ele pertence';


--
-- TOC entry 176 (class 1259 OID 30234)
-- Dependencies: 5
-- Name: processos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE processos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 176
-- Name: processos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('processos_id_seq', 1, true);


--
-- TOC entry 177 (class 1259 OID 30236)
-- Dependencies: 1971 1972 1973 1974 1975 5
-- Name: processos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE processos (
    id integer DEFAULT nextval('processos_id_seq'::regclass) NOT NULL,
    interessado_id integer NOT NULL,
    natureza_id integer NOT NULL,
    servidor_id integer NOT NULL,
    setor_id integer NOT NULL,
    situacao_id integer NOT NULL,
    numero_orgao character varying(100) NOT NULL,
    numero_processo integer NOT NULL,
    numero_ano integer NOT NULL,
    titulo_assunto character varying(200) NOT NULL,
    assunto text NOT NULL,
    data_cadastro timestamp without time zone DEFAULT now() NOT NULL,
    processo_externo boolean DEFAULT false NOT NULL,
    volumes integer DEFAULT 1,
    paginas integer DEFAULT 1,
    documento_numero character varying(50),
    tipo_processo_id integer
);


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 177
-- Name: TABLE processos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE processos IS 'Guarda informacoes sobre os processos';


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.setor_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.setor_id IS 'Setor em que o processo foi cadastrado. � importante manter este dado j� que o servidor pode mudar de setor.';


--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.numero_orgao; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.numero_orgao IS 'O numero do processo e: orgao-numero/ano';


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.numero_processo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.numero_processo IS 'O numero do processo e: orgao-numero/ano';


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.numero_ano; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.numero_ano IS 'O numero do processo e: orgao-numero/ano';


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.volumes; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.volumes IS 'Quantidade de volumes do processo';


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.paginas; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.paginas IS 'N�mero de p�ginas do processo';


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 177
-- Name: COLUMN processos.documento_numero; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN processos.documento_numero IS 'N�mero do documento (of�cio, memorando etc) que gerou o processo';


--
-- TOC entry 178 (class 1259 OID 30247)
-- Dependencies: 5
-- Name: processos_anexos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE processos_anexos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 178
-- Name: processos_anexos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('processos_anexos_id_seq', 1, true);


--
-- TOC entry 179 (class 1259 OID 30249)
-- Dependencies: 1976 1977 5
-- Name: processos_anexos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE processos_anexos (
    id integer DEFAULT nextval('processos_anexos_id_seq'::regclass) NOT NULL,
    processo_principal_id integer NOT NULL,
    processo_anexo_id integer NOT NULL,
    ativo boolean DEFAULT true NOT NULL
);


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 179
-- Name: TABLE processos_anexos; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE processos_anexos IS 'Guarda informacoes sobre anexacao de processos';


--
-- TOC entry 180 (class 1259 OID 30254)
-- Dependencies: 5
-- Name: servidores_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE servidores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 180
-- Name: servidores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('servidores_id_seq', 5802, true);


--
-- TOC entry 181 (class 1259 OID 30256)
-- Dependencies: 1978 1979 1980 5
-- Name: servidores; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE servidores (
    id integer DEFAULT nextval('servidores_id_seq'::regclass) NOT NULL,
    setor_id integer NOT NULL,
    grupo_usuario_id integer NOT NULL,
    cargo_id integer NOT NULL,
    nome character varying(200) NOT NULL,
    cpf character varying(14) NOT NULL,
    matricula character varying(50) NOT NULL,
    login character varying(50) NOT NULL,
    senha character varying(100) NOT NULL,
    ativo boolean DEFAULT true NOT NULL,
    data_cadastro date DEFAULT now() NOT NULL,
    data_permissao_inicio date,
    data_permissao_fim date
);


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 181
-- Name: TABLE servidores; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE servidores IS 'Servidores estaduais';


--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 181
-- Name: COLUMN servidores.setor_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN servidores.setor_id IS 'Setor ao qual o servidor esta atrelado';


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 181
-- Name: COLUMN servidores.grupo_usuario_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN servidores.grupo_usuario_id IS 'Grupo ao qual o servidor pertence';


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 181
-- Name: COLUMN servidores.data_permissao_inicio; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN servidores.data_permissao_inicio IS 'Se estiver preenchido, este campo define a partir de que data o servidor tem acesso ao sistema';


--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 181
-- Name: COLUMN servidores.data_permissao_fim; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN servidores.data_permissao_fim IS 'Se estiver preenchido, este campo define ate qual data o servidor tem acesso ao sistema';


--
-- TOC entry 182 (class 1259 OID 30262)
-- Dependencies: 5
-- Name: setores_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE setores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 182
-- Name: setores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('setores_id_seq', 1, true);


--
-- TOC entry 183 (class 1259 OID 30264)
-- Dependencies: 1981 1982 1983 5
-- Name: setores; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE setores (
    id integer DEFAULT nextval('setores_id_seq'::regclass) NOT NULL,
    orgao_id integer NOT NULL,
    sigla character varying(100),
    descricao character varying(200),
    ativo boolean DEFAULT true NOT NULL,
    permite_divisao boolean DEFAULT false
);


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 183
-- Name: TABLE setores; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE setores IS 'Setores dos orgaos';


--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 183
-- Name: COLUMN setores.orgao_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN setores.orgao_id IS 'Orgao ao qual o setor pertence';


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 183
-- Name: COLUMN setores.sigla; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN setores.sigla IS 'Mnemonico ou sigla para o setor';


--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 183
-- Name: COLUMN setores.descricao; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN setores.descricao IS 'Descricao ou nome do setor';


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 183
-- Name: COLUMN setores.ativo; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN setores.ativo IS 'Se esta ativo ou nao';


--
-- TOC entry 2203 (class 0 OID 0)
-- Dependencies: 183
-- Name: COLUMN setores.permite_divisao; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN setores.permite_divisao IS 'Define se o setor permite que o processo seja dividido entre os servidores';


--
-- TOC entry 184 (class 1259 OID 30270)
-- Dependencies: 5
-- Name: setores_servidores_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE setores_servidores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2204 (class 0 OID 0)
-- Dependencies: 184
-- Name: setores_servidores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('setores_servidores_id_seq', 656, true);


--
-- TOC entry 185 (class 1259 OID 30272)
-- Dependencies: 1984 5
-- Name: setores_servidores; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE setores_servidores (
    id integer DEFAULT nextval('setores_servidores_id_seq'::regclass) NOT NULL,
    setor_id integer NOT NULL,
    servidor_id integer NOT NULL
);


--
-- TOC entry 2205 (class 0 OID 0)
-- Dependencies: 185
-- Name: TABLE setores_servidores; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE setores_servidores IS 'Setores pelos quais um servidor pode responder, al�m do setor principal (associado diretamente � tabela de servidores)';


--
-- TOC entry 186 (class 1259 OID 30276)
-- Dependencies: 5
-- Name: situacoes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE situacoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2206 (class 0 OID 0)
-- Dependencies: 186
-- Name: situacoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('situacoes_id_seq', 4, true);


--
-- TOC entry 187 (class 1259 OID 30278)
-- Dependencies: 1985 5
-- Name: situacoes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE situacoes (
    id integer DEFAULT nextval('situacoes_id_seq'::regclass) NOT NULL,
    descricao character varying(100) NOT NULL,
    sigla character(1) NOT NULL
);


--
-- TOC entry 2207 (class 0 OID 0)
-- Dependencies: 187
-- Name: TABLE situacoes; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE situacoes IS 'Situacoes do processo';


--
-- TOC entry 192 (class 1259 OID 30294)
-- Dependencies: 5
-- Name: tipo_processo_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tipo_processo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2208 (class 0 OID 0)
-- Dependencies: 192
-- Name: tipo_processo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tipo_processo_id_seq', 5, true);


--
-- TOC entry 188 (class 1259 OID 30282)
-- Dependencies: 5
-- Name: tipos_interessado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tipos_interessado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2209 (class 0 OID 0)
-- Dependencies: 188
-- Name: tipos_interessado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tipos_interessado_id_seq', 54, true);


--
-- TOC entry 189 (class 1259 OID 30284)
-- Dependencies: 1986 5
-- Name: tipos_interessado; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE tipos_interessado (
    id integer DEFAULT nextval('tipos_interessado_id_seq'::regclass) NOT NULL,
    descricao character varying(50) NOT NULL
);


--
-- TOC entry 2210 (class 0 OID 0)
-- Dependencies: 189
-- Name: TABLE tipos_interessado; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE tipos_interessado IS 'Tipos de interessado (Pessoa Fisica, Juridica etc)';


--
-- TOC entry 190 (class 1259 OID 30288)
-- Dependencies: 5
-- Name: tipos_mensagem_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tipos_mensagem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2211 (class 0 OID 0)
-- Dependencies: 190
-- Name: tipos_mensagem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tipos_mensagem_id_seq', 4, true);


--
-- TOC entry 191 (class 1259 OID 30290)
-- Dependencies: 1987 5
-- Name: tipos_mensagem; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE tipos_mensagem (
    id integer DEFAULT nextval('tipos_mensagem_id_seq'::regclass) NOT NULL,
    descricao character varying(150) NOT NULL
);


--
-- TOC entry 2212 (class 0 OID 0)
-- Dependencies: 191
-- Name: TABLE tipos_mensagem; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE tipos_mensagem IS 'Tipos de mensagem (d�vida, sugest�o, reclama��o)';


--
-- TOC entry 193 (class 1259 OID 30296)
-- Dependencies: 1988 5
-- Name: tipos_processo; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE tipos_processo (
    id integer DEFAULT nextval('tipo_processo_id_seq'::regclass) NOT NULL,
    descricao character varying(50) NOT NULL
);


--
-- TOC entry 196 (class 1259 OID 30313)
-- Dependencies: 5
-- Name: tipos_tramite_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tipos_tramite_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2213 (class 0 OID 0)
-- Dependencies: 196
-- Name: tipos_tramite_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tipos_tramite_id_seq', 1, false);


--
-- TOC entry 194 (class 1259 OID 30300)
-- Dependencies: 5
-- Name: tramites_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE tramites_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 2214 (class 0 OID 0)
-- Dependencies: 194
-- Name: tramites_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('tramites_id_seq', 1, true);


--
-- TOC entry 195 (class 1259 OID 30302)
-- Dependencies: 1989 1990 1991 5
-- Name: tramites; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE tramites (
    id bigint DEFAULT nextval('tramites_id_seq'::regclass) NOT NULL,
    processo_id integer NOT NULL,
    setor_origem_id integer NOT NULL,
    servidor_origem_id integer NOT NULL,
    data_tramite timestamp without time zone DEFAULT now() NOT NULL,
    setor_recebimento_id integer,
    servidor_recebimento_id integer,
    data_recebimento timestamp without time zone,
    flag_recebimento boolean DEFAULT false NOT NULL,
    numero_folhas smallint,
    observacoes text,
    flag_encaminhado boolean
);


--
-- TOC entry 2215 (class 0 OID 0)
-- Dependencies: 195
-- Name: TABLE tramites; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE tramites IS 'Tramitacoes do processo';


--
-- TOC entry 2216 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.servidor_origem_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.servidor_origem_id IS 'Servidor que cadastrou o tramite';


--
-- TOC entry 2217 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.data_tramite; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.data_tramite IS 'Data de cadastro do tramite';


--
-- TOC entry 2218 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.servidor_recebimento_id; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.servidor_recebimento_id IS 'Servidor que recebeu o processo';


--
-- TOC entry 2219 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.data_recebimento; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.data_recebimento IS 'Data de recebimento do processo';


--
-- TOC entry 2220 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.flag_recebimento; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.flag_recebimento IS 'Se o processo foi recebido no destino ou nao';


--
-- TOC entry 2221 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN tramites.observacoes; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN tramites.observacoes IS 'Observa��es acerca do tr�mite/processo';


--
-- TOC entry 1992 (class 2604 OID 30649)
-- Dependencies: 197 198 198
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY logs ALTER COLUMN id SET DEFAULT nextval('logs_id_seq'::regclass);


--
-- TOC entry 2093 (class 0 OID 30113)
-- Dependencies: 141
-- Data for Name: arquivamentos; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2094 (class 0 OID 30123)
-- Dependencies: 143
-- Data for Name: assuntos_mensagem; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO assuntos_mensagem VALUES (1, 'Login');
INSERT INTO assuntos_mensagem VALUES (2, 'Cadastro de Processos');
INSERT INTO assuntos_mensagem VALUES (3, 'Tr�mites');
INSERT INTO assuntos_mensagem VALUES (4, 'Outros');


--
-- TOC entry 2095 (class 0 OID 30129)
-- Dependencies: 145
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO cargos VALUES (1, 'SIPA');
INSERT INTO cargos VALUES (4, '2005646');
INSERT INTO cargos VALUES (5, 'PREFEITURA MUNICIPAL DE TANQUE D�RCA');
INSERT INTO cargos VALUES (6, 'ASSISTENTE ADMINISTRATIVO');


--
-- TOC entry 2096 (class 0 OID 30135)
-- Dependencies: 147
-- Data for Name: dias_na_mesa; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2097 (class 0 OID 30141)
-- Dependencies: 149
-- Data for Name: divisoes; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2098 (class 0 OID 30147)
-- Dependencies: 151
-- Data for Name: emails_suporte; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO emails_suporte VALUES (1, 'Desenvolvimento', 'cetis.dev@uncisal.edu.br');
INSERT INTO emails_suporte VALUES (2, 'Protocolo ITEC', 'protocolo@itec.al.gov.br');


--
-- TOC entry 2099 (class 0 OID 30153)
-- Dependencies: 153
-- Data for Name: etiquetas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO etiquetas VALUES (1, 'Pimaco 6081 - 10 Linhas', 10, 4.00, 12.00, 102.00, 25.00, 5.00, 4.00, 7.00, 6.00);


--
-- TOC entry 2100 (class 0 OID 30159)
-- Dependencies: 155
-- Data for Name: grupos_usuario; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO grupos_usuario VALUES (1, 'Administrador');
INSERT INTO grupos_usuario VALUES (2, 'Cadastro');
INSERT INTO grupos_usuario VALUES (4, 'Completo');
INSERT INTO grupos_usuario VALUES (6, 'Visitante');
INSERT INTO grupos_usuario VALUES (7, 'Procurador');
INSERT INTO grupos_usuario VALUES (8, 'Coordenador PGE');
INSERT INTO grupos_usuario VALUES (5, 'Tramita��o');


--
-- TOC entry 2101 (class 0 OID 30165)
-- Dependencies: 157
-- Data for Name: historico_devolucoes; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2102 (class 0 OID 30171)
-- Dependencies: 159
-- Data for Name: historico_divisoes; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2103 (class 0 OID 30177)
-- Dependencies: 161
-- Data for Name: interessados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2121 (class 0 OID 30646)
-- Dependencies: 198
-- Data for Name: logs; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO logs VALUES (1, '', 5802, 'LOGIN', NULL, '', 'N;', '2013-04-02 12:38:57.180523');


--
-- TOC entry 2104 (class 0 OID 30183)
-- Dependencies: 163
-- Data for Name: mensagens_suporte; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2105 (class 0 OID 30193)
-- Dependencies: 165
-- Data for Name: modulos; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO modulos VALUES (1, 'Tramitar Processo');
INSERT INTO modulos VALUES (2, 'Receber Processo');
INSERT INTO modulos VALUES (3, 'Cancelar Tramitação');
INSERT INTO modulos VALUES (4, 'Cadastrar Processo');
INSERT INTO modulos VALUES (5, 'Arquivar Processo');
INSERT INTO modulos VALUES (6, 'Desarquivar Processo');
INSERT INTO modulos VALUES (7, 'Paralisar Processo');
INSERT INTO modulos VALUES (8, 'Liberar Processo');
INSERT INTO modulos VALUES (9, 'Anexar Processo');
INSERT INTO modulos VALUES (10, 'Desanexar Processo');
INSERT INTO modulos VALUES (11, 'Distribuir Processo');
INSERT INTO modulos VALUES (12, 'Devolver Processo');
INSERT INTO modulos VALUES (13, 'Consultar Processo');
INSERT INTO modulos VALUES (14, 'Consultar Outros');
INSERT INTO modulos VALUES (15, 'Cadastrar Setor');
INSERT INTO modulos VALUES (16, 'Cadastrar Servidor');
INSERT INTO modulos VALUES (17, 'Cadastrar Outros');
INSERT INTO modulos VALUES (18, 'Cadastrar Todos os Orgaos');
INSERT INTO modulos VALUES (19, 'Relatorio');
INSERT INTO modulos VALUES (20, 'Graficos');
INSERT INTO modulos VALUES (21, 'Administra��o');


--
-- TOC entry 2106 (class 0 OID 30199)
-- Dependencies: 167
-- Data for Name: naturezas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO naturezas VALUES (1, 'ABAIXO ASSINADO', true);
INSERT INTO naturezas VALUES (2, 'ACORD�O', true);
INSERT INTO naturezas VALUES (3, 'ADICIONAL DE DEDICA��O EXCLUSIVA', true);
INSERT INTO naturezas VALUES (4, 'ADICIONAL PERICULOSIDADE', true);
INSERT INTO naturezas VALUES (5, 'ADICIONAL DE ESPECIALIZA��O', true);
INSERT INTO naturezas VALUES (6, 'ADICIONAL DE INATIVIDADE', true);
INSERT INTO naturezas VALUES (7, 'ADICIONAL INSALUBRIDADE', true);
INSERT INTO naturezas VALUES (8, 'AFASTAMENTO DE TITULAR', true);
INSERT INTO naturezas VALUES (9, 'AFASTAMENTO ', true);
INSERT INTO naturezas VALUES (10, 'ANTE-PROJETO DE DECRETO', true);
INSERT INTO naturezas VALUES (11, 'ANTE-PROJETO DE LEI', true);
INSERT INTO naturezas VALUES (12, 'ARQUIVAMENTO DE PROCESSO', true);
INSERT INTO naturezas VALUES (13, 'CARRO PIPA', true);
INSERT INTO naturezas VALUES (14, 'SOLICITA��O DE CASA', true);
INSERT INTO naturezas VALUES (15, 'CESS�O', true);
INSERT INTO naturezas VALUES (16, 'COLOCANDO A DISPOSI��O', true);
INSERT INTO naturezas VALUES (17, 'COMODATO DE IM�VEL', true);
INSERT INTO naturezas VALUES (18, 'COMUNICANDO PARALIZA��O DAS ATIVIDADES', true);
INSERT INTO naturezas VALUES (19, 'CONTRATA��O', true);
INSERT INTO naturezas VALUES (20, 'SOLICITA��O DE CONTRATOS', true);
INSERT INTO naturezas VALUES (22, 'CR�DITO ESPECIAL', true);
INSERT INTO naturezas VALUES (23, 'CR�DITO SUPLEMENTAR', true);
INSERT INTO naturezas VALUES (24, 'DECRETO EXECUTIVO', true);
INSERT INTO naturezas VALUES (25, 'DECRETO LEGISLATIVO', true);
INSERT INTO naturezas VALUES (26, 'DESARQUIVAMENTO DE PROCESSOS', true);
INSERT INTO naturezas VALUES (27, 'DESIGNA��O DE CONSELHEIROS', true);
INSERT INTO naturezas VALUES (28, 'DESIGNA��O DE DIRETOR', true);
INSERT INTO naturezas VALUES (29, 'DESVIO DE FUN��O', true);
INSERT INTO naturezas VALUES (30, 'DEVOLU��O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (31, 'DI�RIA(S)', true);
INSERT INTO naturezas VALUES (32, 'DISPENSA DE DIRETOR', true);
INSERT INTO naturezas VALUES (33, 'DISPENSA DE PONTO', true);
INSERT INTO naturezas VALUES (38, 'DIVERSOS ASSUNTOS', true);
INSERT INTO naturezas VALUES (39, 'DOA��O DE TERRENO OU IM�VEL', true);
INSERT INTO naturezas VALUES (41, 'MINUTA DE DECRETO', true);
INSERT INTO naturezas VALUES (42, 'ENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (43, 'EXCLUS�O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (44, 'GRATIFICA��O', true);
INSERT INTO naturezas VALUES (45, 'HOMOLOGA��O', true);
INSERT INTO naturezas VALUES (46, 'IMPLANTA��O DE SAL�RIO FAM�LIA', true);
INSERT INTO naturezas VALUES (47, 'INCORPORA��O GRATIFICA��O VENCIMENTOS', true);
INSERT INTO naturezas VALUES (48, 'INDICA��O DE REPRESENTANTE', true);
INSERT INTO naturezas VALUES (49, 'INQU�RITO ADMINISTRATIVO', true);
INSERT INTO naturezas VALUES (50, 'ISEN��O DE ICMS', true);
INSERT INTO naturezas VALUES (51, 'ISEN��O DE TAXAS', true);
INSERT INTO naturezas VALUES (52, 'ISONOMIA SALARIAL', true);
INSERT INTO naturezas VALUES (53, 'JUN��O DE CARGA HOR�RIA', true);
INSERT INTO naturezas VALUES (54, 'LIBERA��O DE VERBA', true);
INSERT INTO naturezas VALUES (55, 'LICEN�A PARA PARTICIPAR DE CURSO', true);
INSERT INTO naturezas VALUES (56, 'LICEN�A REMUNERADA', true);
INSERT INTO naturezas VALUES (57, 'LICITA��O', true);
INSERT INTO naturezas VALUES (58, 'LOCA��O DE IM�VEL', true);
INSERT INTO naturezas VALUES (59, 'MANDADO DE SEGURAN�A', true);
INSERT INTO naturezas VALUES (60, 'NOMEA��O CONCURSO P�BLICO', true);
INSERT INTO naturezas VALUES (63, 'PENS�O ESPECIAL', true);
INSERT INTO naturezas VALUES (64, 'PERMAN�NCIA DE SERVIDOR', true);
INSERT INTO naturezas VALUES (65, 'PERMUTA DE FUNCION�RIO', true);
INSERT INTO naturezas VALUES (66, 'AUTORIZA��O PARA FIRMAR CONTRATO', true);
INSERT INTO naturezas VALUES (67, 'PROJETO DE LEI', true);
INSERT INTO naturezas VALUES (68, 'PRORROGA��O DE GRATIFICA��O', true);
INSERT INTO naturezas VALUES (70, 'PRORROGA��O DE LICEN�A', true);
INSERT INTO naturezas VALUES (72, 'QUINQUENIO', true);
INSERT INTO naturezas VALUES (73, 'READAPTA��O DE CARGO', true);
INSERT INTO naturezas VALUES (75, 'REAJUSTE SALARIAL', true);
INSERT INTO naturezas VALUES (76, 'RECLASSIFICA��O', true);
INSERT INTO naturezas VALUES (77, 'REDISTRIBUI��O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (78, 'REENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (79, 'REGULARIZA��O FUNCIONAL', true);
INSERT INTO naturezas VALUES (80, 'REIMPLANTA��O DE GRATIFICA��O', true);
INSERT INTO naturezas VALUES (81, 'REIMPLANTA��O DE VENCIMENTO', true);
INSERT INTO naturezas VALUES (82, 'REINTEGRA��O AO SERVI�O P�BLICO', true);
INSERT INTO naturezas VALUES (83, 'REMISS�O DE FOROS', true);
INSERT INTO naturezas VALUES (84, 'REMO��O', true);
INSERT INTO naturezas VALUES (85, 'RENOVA��O DE CONTRATO', true);
INSERT INTO naturezas VALUES (87, 'REPASSE DE VERBA', true);
INSERT INTO naturezas VALUES (88, 'REQUERIMENTO E INDICA��ES DE VEREADORES', true);
INSERT INTO naturezas VALUES (89, 'REITICA��O DE APOSENTADORIA', true);
INSERT INTO naturezas VALUES (90, 'RETIFICA��O DE RESERVA REMUNERADA', true);
INSERT INTO naturezas VALUES (91, 'RETIFICA��O DE REFORMAR', true);
INSERT INTO naturezas VALUES (92, 'RETORNO DE FUNCION�RIO', true);
INSERT INTO naturezas VALUES (93, 'REVIS�O DE PROCESSOS', true);
INSERT INTO naturezas VALUES (95, 'REVOGA��O DE LEIS', true);
INSERT INTO naturezas VALUES (96, 'S�MBOLOS DO ESTADO', true);
INSERT INTO naturezas VALUES (97, 'SUBSTITUI��O DE TITULAR', true);
INSERT INTO naturezas VALUES (98, 'SUSPENS�O DE  CONTRATO', true);
INSERT INTO naturezas VALUES (101, 'APOSENTADORIA', true);
INSERT INTO naturezas VALUES (102, 'ASCENS�O', true);
INSERT INTO naturezas VALUES (103, 'AUX�LIO DE INVALIDEZ', true);
INSERT INTO naturezas VALUES (104, 'DEMISS�O', true);
INSERT INTO naturezas VALUES (105, 'INGRESSO NA PARTE PERMANENTE', true);
INSERT INTO naturezas VALUES (106, 'LICEN�A SEM VENCIMENTOS', true);
INSERT INTO naturezas VALUES (109, 'PROMO��O', true);
INSERT INTO naturezas VALUES (111, 'RECONHECIMENTO DE CURSO', true);
INSERT INTO naturezas VALUES (112, 'REFORMA', true);
INSERT INTO naturezas VALUES (113, 'TRANSFER�NCIA PARA RESERVA N�O REMUNERADA', true);
INSERT INTO naturezas VALUES (115, 'HORARIO ESPECIAL DE TRABALHO', true);
INSERT INTO naturezas VALUES (117, 'POSSE DE IM�VEL', true);
INSERT INTO naturezas VALUES (118, 'TRANSPOSI��O DE CARGO', true);
INSERT INTO naturezas VALUES (119, 'EXONERA��O', true);
INSERT INTO naturezas VALUES (121, 'EXONERA��O E NOMEA��O CARGO EM COMISS�O', true);
INSERT INTO naturezas VALUES (123, 'NOMEA��O CARGO COMISSIONADO', true);
INSERT INTO naturezas VALUES (127, 'REVOGA��O DE DECRETO', true);
INSERT INTO naturezas VALUES (129, 'ABONO PECUNI�RIO', true);
INSERT INTO naturezas VALUES (130, 'ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (131, 'AJUDA FINANCEIRA', true);
INSERT INTO naturezas VALUES (132, 'ANU�NIO', true);
INSERT INTO naturezas VALUES (133, 'AUTORIZA��O DE SERVI�OS', true);
INSERT INTO naturezas VALUES (135, 'COMPRA DE MATERIAL', true);
INSERT INTO naturezas VALUES (136, 'FORNECIMENTO DE MATERIAL', true);
INSERT INTO naturezas VALUES (137, 'INDICA��O', true);
INSERT INTO naturezas VALUES (138, 'LICEN�A ESPECIAL', true);
INSERT INTO naturezas VALUES (139, 'PAGAMENTO', true);
INSERT INTO naturezas VALUES (141, 'PASSAGENS', true);
INSERT INTO naturezas VALUES (144, 'SOLICITA��O DE VE�CULOS', true);
INSERT INTO naturezas VALUES (145, 'AFASTAMENTO PARA PARTICIPAR DE CURSO', true);
INSERT INTO naturezas VALUES (147, 'DESIGNA��O DE PORTARIA', true);
INSERT INTO naturezas VALUES (148, 'SOLICITA��O DE MATERIAL', true);
INSERT INTO naturezas VALUES (149, 'ABONO FAM�LIA', true);
INSERT INTO naturezas VALUES (150, 'RESSARCIMENTO', true);
INSERT INTO naturezas VALUES (151, 'ALIENA��O', true);
INSERT INTO naturezas VALUES (152, 'AUMENTO DE CARGA HOR�RIA', true);
INSERT INTO naturezas VALUES (153, 'MINUTA DE PROJETO DE LEI', true);
INSERT INTO naturezas VALUES (154, 'F�RIAS', true);
INSERT INTO naturezas VALUES (155, 'ABONO DE F�RIAS', true);
INSERT INTO naturezas VALUES (156, 'RELAT�RIO', true);
INSERT INTO naturezas VALUES (157, 'DESIGNA��O DE COORDENADOR', true);
INSERT INTO naturezas VALUES (158, 'REVIS�O DE ENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (159, 'MINUTA DE CONV�NIO', true);
INSERT INTO naturezas VALUES (161, 'LOTA��O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (162, 'RESPOSTA A CIRCULAR', true);
INSERT INTO naturezas VALUES (164, 'DOM�NIO DE USO DE IM�VEL', true);
INSERT INTO naturezas VALUES (166, 'DESAPROPRIA��O', true);
INSERT INTO naturezas VALUES (167, 'PAGAMENTO DE VANTAGENS', true);
INSERT INTO naturezas VALUES (168, 'INCENTIVO FISCAL', true);
INSERT INTO naturezas VALUES (169, 'PAGAMENTO DE DIFEREN�A SALARIAL', true);
INSERT INTO naturezas VALUES (170, 'DESEFICACIZA��O', true);
INSERT INTO naturezas VALUES (180, 'SOL. EMPENHO DA FOLHA DE PESSOAL', true);
INSERT INTO naturezas VALUES (181, 'IMPLANTA��O DE HORAS EXTRAS', true);
INSERT INTO naturezas VALUES (182, 'IMPLANTA��O DE ADICIONAL NOTURNO', true);
INSERT INTO naturezas VALUES (183, 'LOCA��O DE VE�CULO', true);
INSERT INTO naturezas VALUES (184, 'MANUTEN��O DE EQUIPAMENTO', true);
INSERT INTO naturezas VALUES (185, 'SERVI�O DE REFORMA', true);
INSERT INTO naturezas VALUES (186, 'CONFIGURA��O DE COMPUTADORES', true);
INSERT INTO naturezas VALUES (187, 'IMPLANTA��O DE SISTEMA', true);
INSERT INTO naturezas VALUES (21, 'CONV�NIO(S)', true);
INSERT INTO naturezas VALUES (188, 'REQUERIMENTO', true);
INSERT INTO naturezas VALUES (189, 'AQUISI��O DE EQUIPAMENTOS', true);
INSERT INTO naturezas VALUES (190, 'BLOQUEIO DE SOFTWARE', true);
INSERT INTO naturezas VALUES (191, 'MONTAGEM', true);
INSERT INTO naturezas VALUES (192, 'AQUISI��O DE MATERIAL', true);
INSERT INTO naturezas VALUES (194, 'ENCAMINHAMENTO', true);
INSERT INTO naturezas VALUES (196, 'COMISS�O', true);
INSERT INTO naturezas VALUES (197, 'SOLICITA��O DE ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (198, 'RENOVA��O DE ASSINATURA', true);
INSERT INTO naturezas VALUES (199, 'ALTERA��O DE PROGRAMA', true);
INSERT INTO naturezas VALUES (200, 'COMUNICA��O', true);
INSERT INTO naturezas VALUES (201, 'CONVITE', true);
INSERT INTO naturezas VALUES (202, 'SUBSTITUI��O', true);
INSERT INTO naturezas VALUES (203, 'REALIZA��O DE PER�CIA', true);
INSERT INTO naturezas VALUES (204, 'COMUNICADO', true);
INSERT INTO naturezas VALUES (205, 'IMPLANTA��O', true);
INSERT INTO naturezas VALUES (206, 'INFORMA��O', true);
INSERT INTO naturezas VALUES (207, 'INSTALA��O DE CIRCUITO', true);
INSERT INTO naturezas VALUES (208, 'FICHA FINANCEIRA', true);
INSERT INTO naturezas VALUES (209, 'APRESENTA��O', true);
INSERT INTO naturezas VALUES (210, 'INSTALA��O DE LINK', true);
INSERT INTO naturezas VALUES (211, 'REVIS�O', true);
INSERT INTO naturezas VALUES (212, 'IMPLEMENTA��O DE SISTEMA', true);
INSERT INTO naturezas VALUES (213, 'CERTID�O DE TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (214, 'DEVOLU��O ', true);
INSERT INTO naturezas VALUES (215, 'LIBERA��O', true);
INSERT INTO naturezas VALUES (216, 'SOLICITA��O DE CURSO', true);
INSERT INTO naturezas VALUES (217, 'INSTALA��O DE EQUIPAMENTO', true);
INSERT INTO naturezas VALUES (218, 'INCORPORA��O', true);
INSERT INTO naturezas VALUES (219, 'PRESTA��O DE CONTAS', true);
INSERT INTO naturezas VALUES (1000, 'A DISPOSI��O', true);
INSERT INTO naturezas VALUES (1001, 'ABANDONO DE CARGO', true);
INSERT INTO naturezas VALUES (1002, 'A��O JUDICIAL', true);
INSERT INTO naturezas VALUES (1003, 'A��O MONIT�RIA', true);
INSERT INTO naturezas VALUES (1005, 'ACUMULA��O DE CARGOS', true);
INSERT INTO naturezas VALUES (1006, 'ADENDO A OF�CIO', true);
INSERT INTO naturezas VALUES (1008, 'ADICIONAL DE FIM DE CARREIRA', true);
INSERT INTO naturezas VALUES (1009, 'ADICIONAL DE PERICULOSIDADE', true);
INSERT INTO naturezas VALUES (1010, 'ADICIONAL NOTURNO', true);
INSERT INTO naturezas VALUES (1011, 'ADITIVO DE CONTRATO', true);
INSERT INTO naturezas VALUES (1012, 'AFASTAMENTO DE SALA DE AULA', true);
INSERT INTO naturezas VALUES (1013, 'AJUDA DE CUSTO', true);
INSERT INTO naturezas VALUES (1014, 'ALUGUEL DE IM�VEL', true);
INSERT INTO naturezas VALUES (1015, 'ALVAR�', true);
INSERT INTO naturezas VALUES (1016, 'ANTECIPA��O SALARIAL', true);
INSERT INTO naturezas VALUES (1019, 'ANULA��O', true);
INSERT INTO naturezas VALUES (1021, 'APOSENTADORIA COMPULS�RIA', true);
INSERT INTO naturezas VALUES (1022, 'APOSENTADORIA P/INVALIDEZ', true);
INSERT INTO naturezas VALUES (1023, 'APOSENTADORIA PROPORCIONAL', true);
INSERT INTO naturezas VALUES (1024, 'APOSTILAMENTO', true);
INSERT INTO naturezas VALUES (1025, 'APOSTILAMENTO DE QUINQU�NIO', true);
INSERT INTO naturezas VALUES (1026, 'APOSTILAMENTO E GRATIFICA��O', true);
INSERT INTO naturezas VALUES (1027, 'AQUISI��O DE BENS', true);
INSERT INTO naturezas VALUES (1029, 'ASCENS�O DE N�VEL', true);
INSERT INTO naturezas VALUES (1030, 'ASSINATURA', true);
INSERT INTO naturezas VALUES (1031, 'ATUALIZA��O DE VENCIMENO E DIFEREN�A RETROATIVA', true);
INSERT INTO naturezas VALUES (1032, 'ATUALIZA��O DE VENCIMENTOS', true);
INSERT INTO naturezas VALUES (1033, 'AUTO DE INFRA��O', true);
INSERT INTO naturezas VALUES (1034, 'DI�RIA', true);
INSERT INTO naturezas VALUES (1035, 'AUX�LIO', true);
INSERT INTO naturezas VALUES (1036, 'AUX�LIO DOEN�A', true);
INSERT INTO naturezas VALUES (1037, 'AUX�LIO FUNERAL', true);
INSERT INTO naturezas VALUES (1038, 'FICHA FINANCEIRA', true);
INSERT INTO naturezas VALUES (1039, 'AVERBA��O DE F�RIAS N�O GOZADAS', true);
INSERT INTO naturezas VALUES (1040, 'AVERBA��O DE LICEN�A ESPECIAL', true);
INSERT INTO naturezas VALUES (1041, 'AVERBA��O DE TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (1042, 'REINTEGRA��O DE POSSE', true);
INSERT INTO naturezas VALUES (1043, 'BOLSA DE ESTUDO', true);
INSERT INTO naturezas VALUES (1044, 'CADASTRO', true);
INSERT INTO naturezas VALUES (1045, 'CANCELAMENTO', true);
INSERT INTO naturezas VALUES (1046, 'CARGO A DISPOSI��O', true);
INSERT INTO naturezas VALUES (1047, 'CERTID�O/DECRETO', true);
INSERT INTO naturezas VALUES (1049, 'COMPLEMENTA��O DE PENS�O', true);
INSERT INTO naturezas VALUES (1050, 'COMPLEMENTA��O SALARIAL', true);
INSERT INTO naturezas VALUES (1051, 'COMUNICA��O DE FURTO', true);
INSERT INTO naturezas VALUES (1052, 'COMUNICA��O DE PARALISA��O', true);
INSERT INTO naturezas VALUES (1053, 'CONCESS�O DE 40 HORAS', true);
INSERT INTO naturezas VALUES (1054, 'CONCESS�O DE GRATIFICA��O (�ES)', true);
INSERT INTO naturezas VALUES (1055, 'RECLAMA��O', true);
INSERT INTO naturezas VALUES (1057, 'CONSULTA', true);
INSERT INTO naturezas VALUES (1058, 'CONTINUA��O DE ABONO', true);
INSERT INTO naturezas VALUES (1059, 'CONTINUA��O DE PENS�O', true);
INSERT INTO naturezas VALUES (1060, 'CONTINUA��O DE VANTAGENS', true);
INSERT INTO naturezas VALUES (1061, 'CONTRATA��O ESTAGI�RIO', true);
INSERT INTO naturezas VALUES (1062, 'CONTRATO', true);
INSERT INTO naturezas VALUES (1063, 'CONTRIBUI��O SOCIAL MENSAL', true);
INSERT INTO naturezas VALUES (1064, 'CONVENIO', true);
INSERT INTO naturezas VALUES (1065, 'CONVERS�O DE F�RIAS EM PEC�NIA', true);
INSERT INTO naturezas VALUES (1066, 'CONVITE', true);
INSERT INTO naturezas VALUES (1067, 'CREDITO SUPLEMENTAR', true);
INSERT INTO naturezas VALUES (1068, 'CRIA��O DE C�DIGO OU RUBRICA', true);
INSERT INTO naturezas VALUES (1069, 'DECLARA��O', true);
INSERT INTO naturezas VALUES (1070, 'DECRETO', true);
INSERT INTO naturezas VALUES (1071, 'DEMISSAO', true);
INSERT INTO naturezas VALUES (1072, 'DEN�NCIA', true);
INSERT INTO naturezas VALUES (1073, 'DESANEXA��O', true);
INSERT INTO naturezas VALUES (1074, 'DESAPARECIMENTO DE CHEQUES, DOCUMENTOS, ETC...', true);
INSERT INTO naturezas VALUES (1075, 'DESARQUIVAMENTO DE PROCESSO', true);
INSERT INTO naturezas VALUES (1076, 'DESAVERBA��O DE TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (1077, 'DESIST�NCIA DE PEDIDO FORMULADO', true);
INSERT INTO naturezas VALUES (1078, 'DESVIO DE FUNCAO', true);
INSERT INTO naturezas VALUES (1079, 'DEVOLUCAO', true);
INSERT INTO naturezas VALUES (1080, 'DEVOLU��O DE DESCONTO', true);
INSERT INTO naturezas VALUES (1081, 'DIFEREN�A CARGO COMISSARO,FUNC.GRATIFICADA, ETC...', true);
INSERT INTO naturezas VALUES (1082, 'DIFEREN�A RETROATIVA', true);
INSERT INTO naturezas VALUES (1083, 'DIFEREN�A RETROATIVA DO SAL�RIO FAM�LIA', true);
INSERT INTO naturezas VALUES (1084, 'DIFEREN�A SALARIAL', true);
INSERT INTO naturezas VALUES (1085, 'DILIG�NCIA', true);
INSERT INTO naturezas VALUES (1086, 'DISPONIBILIDADE', true);
INSERT INTO naturezas VALUES (1087, 'DOA��O', true);
INSERT INTO naturezas VALUES (1088, 'ELABORA��O OR�AMENT�RIA', true);
INSERT INTO naturezas VALUES (1089, 'EMPENHO', true);
INSERT INTO naturezas VALUES (1090, 'ENCAMINHAMENTO DE PROPOSTA', true);
INSERT INTO naturezas VALUES (1091, 'ENCONTRO', true);
INSERT INTO naturezas VALUES (1093, 'ENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (1094, 'ENQUADRAMENTO E DIFERENCA RETROATIVA', true);
INSERT INTO naturezas VALUES (1095, 'EQUIPARA��O SALARIAL', true);
INSERT INTO naturezas VALUES (1096, 'EXCLUS�O', true);
INSERT INTO naturezas VALUES (1097, 'EXONERA��O', true);
INSERT INTO naturezas VALUES (1098, 'FOLHA DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (1099, 'FREQ.DOS SERVIDORES, HORA EXTRA E ADICIONAL', true);
INSERT INTO naturezas VALUES (1100, 'FREQU�NCIA', true);
INSERT INTO naturezas VALUES (1101, 'GRATIFICA��O DE ESPEC.MESTRADO OU DOUTORADO', true);
INSERT INTO naturezas VALUES (1102, 'GRATIFICA��O DE SERVI�OS EXTRAORDIN�RIOS', true);
INSERT INTO naturezas VALUES (1103, 'HOR�RIO ESPECIAL', true);
INSERT INTO naturezas VALUES (1104, 'IMPLANTA��O', true);
INSERT INTO naturezas VALUES (1105, 'INCENTIVO DE QUALIFICACAO PROFISSIONAL', true);
INSERT INTO naturezas VALUES (1106, 'INCORPORA��O DE GRATIFICA��O', true);
INSERT INTO naturezas VALUES (1107, 'INCORRECAO', true);
INSERT INTO naturezas VALUES (1108, 'INDICACAO', true);
INSERT INTO naturezas VALUES (1109, 'INGRESSO NA PARTE PERMANENTE', true);
INSERT INTO naturezas VALUES (1110, 'INQUERITO ADMINISTRATIVO', true);
INSERT INTO naturezas VALUES (1111, 'INSALUBRIDADE', true);
INSERT INTO naturezas VALUES (1112, 'INTIMA��O', true);
INSERT INTO naturezas VALUES (1113, 'INSEN��O DE DESCONTOS', true);
INSERT INTO naturezas VALUES (1114, 'ISONOMIA SALARIAL', true);
INSERT INTO naturezas VALUES (1115, 'JURISPRUD�NCIA ADMINISTRATIVA', true);
INSERT INTO naturezas VALUES (1116, 'LIBERA��O DE CONTRA CHEQUE', true);
INSERT INTO naturezas VALUES (1117, 'LIBERA��O DE PAGAMENTO OU PAGAMENTO ATRASADO', true);
INSERT INTO naturezas VALUES (1118, 'LICEN�A A FUNCION�RIO P/ACOMPANHAR O C�NJUGUE', true);
INSERT INTO naturezas VALUES (1119, 'LICEN�A ALTERNATIVA', true);
INSERT INTO naturezas VALUES (1121, 'LICEN�A M�DICA', true);
INSERT INTO naturezas VALUES (1122, 'LICEN�A PARA INTERESSE PARTICULAR', true);
INSERT INTO naturezas VALUES (1123, 'LICEN�A PARA QUALIFICA��O PROFISSIONAL', true);
INSERT INTO naturezas VALUES (1124, 'LICEN�A POR TEMPO INDETERMINADO', true);
INSERT INTO naturezas VALUES (1125, 'LICEN�A PR�MIO', true);
INSERT INTO naturezas VALUES (1127, 'LISTAGEM DE CONV�NIO', true);
INSERT INTO naturezas VALUES (1128, 'LOTA��O', true);
INSERT INTO naturezas VALUES (1129, 'LOTA��O GEN�RICA', true);
INSERT INTO naturezas VALUES (1130, 'MANDADO DE CITA��O', true);
INSERT INTO naturezas VALUES (1132, 'MUDAN�A DE CARGA HOR�RIA', true);
INSERT INTO naturezas VALUES (1133, 'MUDAN�A DE CARGO', true);
INSERT INTO naturezas VALUES (1134, 'NOMEA��O', true);
INSERT INTO naturezas VALUES (1135, 'NORMATIZA��O DA INFORM�TICA NA SEARHP', true);
INSERT INTO naturezas VALUES (1136, 'NOTIFICA��O', true);
INSERT INTO naturezas VALUES (1137, 'OP��O EM PERCENTUAL DO CARGO EM COMISS�O', true);
INSERT INTO naturezas VALUES (1138, 'OP��O FEITA PELO SERVIDOR', true);
INSERT INTO naturezas VALUES (1139, 'OR�AMENTO', true);
INSERT INTO naturezas VALUES (1140, 'P.D.V. PROGRAMA DE DEMISS�O VOLUNT�RIA', true);
INSERT INTO naturezas VALUES (1141, 'PAGAMENTO DE F�RIAS', true);
INSERT INTO naturezas VALUES (1142, 'PAGAMENTO DIVERSOS', true);
INSERT INTO naturezas VALUES (1143, 'PAGAMENTO DE 13� SAL�RIO E OUTROS', true);
INSERT INTO naturezas VALUES (1144, 'PARECER T�CNICO', true);
INSERT INTO naturezas VALUES (1145, 'PAUTA DE REIVINDICA��ES', true);
INSERT INTO naturezas VALUES (1146, 'PEDIDO DE CORRE��O SOBRE OS VALORES RECEBIDOS', true);
INSERT INTO naturezas VALUES (1147, 'PENS�O', true);
INSERT INTO naturezas VALUES (1148, 'PENS�O ALIMENT�CIA', true);
INSERT INTO naturezas VALUES (1149, 'PERMAN�NCIA', true);
INSERT INTO naturezas VALUES (1150, 'PERMUTA E CONSTRU��O DE IM�VEIS', true);
INSERT INTO naturezas VALUES (1151, 'PAGTO.DE ABONO PECUNI�RIO E LICEN�A ESP.N�O GOZADA', true);
INSERT INTO naturezas VALUES (1152, 'PRESCRI��O', true);
INSERT INTO naturezas VALUES (1154, 'PROGRAMA DE RESTRUTURA��O DOS ESTADOS', true);
INSERT INTO naturezas VALUES (1155, 'PROGRESS�O HORIZONTAL', true);
INSERT INTO naturezas VALUES (1156, 'PROGRESS�O HORIZONTAL E ANU�NIOS', true);
INSERT INTO naturezas VALUES (1157, 'PROGRESS�O VERTICAL', true);
INSERT INTO naturezas VALUES (1158, 'PROJETO DE INFORMATIZA��O SEARHP', true);
INSERT INTO naturezas VALUES (1161, 'PROPOSTA', true);
INSERT INTO naturezas VALUES (1162, 'PROPOSTA PARA ABERTURA DE CONCURSO P�BLICO', true);
INSERT INTO naturezas VALUES (1163, 'PRORROGA��O DE AFASTAMENTO', true);
INSERT INTO naturezas VALUES (1164, 'PRORROGA��O DE CONTRATO', true);
INSERT INTO naturezas VALUES (1165, 'PROVENTOS', true);
INSERT INTO naturezas VALUES (1166, 'QUANTITATIVO DE CARGOS', true);
INSERT INTO naturezas VALUES (1167, 'REAJUSTE DE PENS�O ESPECIAL', true);
INSERT INTO naturezas VALUES (1168, 'REATIVAR CHEQUE SAL�RIO', true);
INSERT INTO naturezas VALUES (1169, 'RECADASTRAMENTO', true);
INSERT INTO naturezas VALUES (1170, 'RECICLAGEM', true);
INSERT INTO naturezas VALUES (1171, 'RECONSIDERA��O DE PARECER', true);
INSERT INTO naturezas VALUES (1172, 'REDISTRIBUI��O', true);
INSERT INTO naturezas VALUES (1173, 'REDU��O DA FOLHA DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (1174, 'REEMISS�O DE CHEQUE SAL�RIO', true);
INSERT INTO naturezas VALUES (1175, 'REIMPLANTA��O DE DESCONTOS', true);
INSERT INTO naturezas VALUES (1176, 'REIMPLANTACAO DE VANTAGENS', true);
INSERT INTO naturezas VALUES (1177, 'REIVINDICA��O', true);
INSERT INTO naturezas VALUES (1178, 'REL.DE SERVIDORES SAL.FAM�LIA E SEUS DEPENDENTES', true);
INSERT INTO naturezas VALUES (1179, 'RELA��O DE FUNCION�RIOS', true);
INSERT INTO naturezas VALUES (1180, 'RELA��O DE PATRIM�NIO', true);
INSERT INTO naturezas VALUES (1181, 'RELA��O DOS CARGOS EM COMISS�O DESTE �RG�O', true);
INSERT INTO naturezas VALUES (1182, 'RELA��O NOMINAL DOS SERVIDORES QUE ACUMULAM', true);
INSERT INTO naturezas VALUES (1183, 'RELAT�RIO DE AUDITORIA', true);
INSERT INTO naturezas VALUES (1184, 'RELAT�RIO DE PENALIDADES DIVERSAS', true);
INSERT INTO naturezas VALUES (1185, 'REMANEJAMENTO DE FUN��O', true);
INSERT INTO naturezas VALUES (1186, 'REMESSA DAS FICHAS FUNCIONAIS DOS SERVIDORES', true);
INSERT INTO naturezas VALUES (1188, 'REN�NCIA DE LICENCA, APOSENTADORIA, ETC...', true);
INSERT INTO naturezas VALUES (1190, 'RESUMO DE FOLHA DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (1191, 'RETEN��O DE CHEQUE SAL�RIO', true);
INSERT INTO naturezas VALUES (1192, 'RETIFICA��O', true);
INSERT INTO naturezas VALUES (1193, 'RETIFICA��O DE APOSENTADORIA', true);
INSERT INTO naturezas VALUES (1194, 'RETORNO A SUA FUN��O AP�S T�RMINO DE LICEN�A', true);
INSERT INTO naturezas VALUES (1195, 'RETORNO AO QUADRO FUNCIONAL DO �RG�O', true);
INSERT INTO naturezas VALUES (1196, 'REVALIDAR PENS�O', true);
INSERT INTO naturezas VALUES (1197, 'REVIS�O DE APOSENTADORIA', true);
INSERT INTO naturezas VALUES (1198, 'REVIS�O C�LCULO PENS�O', true);
INSERT INTO naturezas VALUES (1199, 'REVIS�O DE C�LCULOS', true);
INSERT INTO naturezas VALUES (1200, 'REVIS�O DE C�LCULOS DO PASEP', true);
INSERT INTO naturezas VALUES (1201, 'REVIS�O DO ENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (1202, 'REVOGA��O DE PORTARIA', true);
INSERT INTO naturezas VALUES (1203, 'SAL�RIO FAM�LIA', true);
INSERT INTO naturezas VALUES (1204, 'SEGUNDA VIA DA DECLARA��O DE RENDIMENTOS', true);
INSERT INTO naturezas VALUES (1205, 'SOBRESTAMENTO DO PROCESSO', true);
INSERT INTO naturezas VALUES (1206, 'SOLICITA��O DE C�LCULOS DO F.G.T.S.', true);
INSERT INTO naturezas VALUES (1207, 'SOLICITA��O DE DEPUTADO', true);
INSERT INTO naturezas VALUES (1208, 'SOLICITA��O DE IMPLANTA��O DE VANT. CONCEDIDA', true);
INSERT INTO naturezas VALUES (1209, 'SOLICITA��O DE LISTAGEM DE FUNC.DE 88 A 31/05/94', true);
INSERT INTO naturezas VALUES (1210, 'SOLICITA��O DE SINDIC�NCIA', true);
INSERT INTO naturezas VALUES (1211, 'SOLICITA��O DE INFORMA��O', true);
INSERT INTO naturezas VALUES (1213, 'SUSPENS�O DE DESCONTO', true);
INSERT INTO naturezas VALUES (1214, 'SUSPENS�O DE SUAS FUN��ES', true);
INSERT INTO naturezas VALUES (1215, 'SUSTAR PAGAMENTO DO(S) SERVIDORE(S)', true);
INSERT INTO naturezas VALUES (1216, 'TABELA SALARIAL', true);
INSERT INTO naturezas VALUES (1217, 'TRANSFER�NCIA', true);
INSERT INTO naturezas VALUES (1218, 'TRANSFER�NCIA DE APOSENTADORIA', true);
INSERT INTO naturezas VALUES (1220, 'TREINAMENTO OU CURSO', true);
INSERT INTO naturezas VALUES (1221, 'TRI�NIO', true);
INSERT INTO naturezas VALUES (1222, 'TRIMESTRALIDADE', true);
INSERT INTO naturezas VALUES (1223, 'VALE TRANSPORTE', true);
INSERT INTO naturezas VALUES (1224, 'VANTAGENS', true);
INSERT INTO naturezas VALUES (1225, 'VENDA DE IM�VEL', true);
INSERT INTO naturezas VALUES (1226, 'VERIFICAR AC�MULO DE CARGO', true);
INSERT INTO naturezas VALUES (1228, 'A��O USOCAPI�O', true);
INSERT INTO naturezas VALUES (1230, 'LAUD�MIO', true);
INSERT INTO naturezas VALUES (1231, 'RETROATIVO DE SAL�RIO FAM�LIA', true);
INSERT INTO naturezas VALUES (1232, '510024-PRESTA��O DE CONTAS DE ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (1233, 'PASSAGENS A�REA E DI�RIAS', true);
INSERT INTO naturezas VALUES (1234, 'DIARIAS', true);
INSERT INTO naturezas VALUES (1235, 'PEDIDO DE C�DIGO', true);
INSERT INTO naturezas VALUES (1236, 'A��O CAUTELAR', true);
INSERT INTO naturezas VALUES (1237, 'ANTEPROJETO DE LEI DE REESTRUTURA��O', true);
INSERT INTO naturezas VALUES (1238, 'CONCURSO P�BLICO', true);
INSERT INTO naturezas VALUES (1239, 'REFORMA ADMINISTRATIVA', true);
INSERT INTO naturezas VALUES (1240, 'ENCAMINHAMENTO (FAZ)', true);
INSERT INTO naturezas VALUES (1242, 'FUN��O GRATIFICADA', true);
INSERT INTO naturezas VALUES (1243, 'RETORNO DE FUN��O GRATIFICADA', true);
INSERT INTO naturezas VALUES (1244, 'SUSPENS�O DE LICEN�A SEM VENCIMENTO', true);
INSERT INTO naturezas VALUES (1245, 'PAGAMENTOS ATRASADOS', true);
INSERT INTO naturezas VALUES (1246, 'AFASTAMENTO DE FUN��O', true);
INSERT INTO naturezas VALUES (1247, 'REMISS�O DE FORO', true);
INSERT INTO naturezas VALUES (1248, 'RENOVA�AO DE LICEN�A', true);
INSERT INTO naturezas VALUES (1249, 'COMODATO', true);
INSERT INTO naturezas VALUES (1250, 'SOLICITA CRIAR MATR�CULA', true);
INSERT INTO naturezas VALUES (1251, 'REENCAMINHAMENTO DE INSTRU��ES', true);
INSERT INTO naturezas VALUES (1253, 'REMISS�O CHEQUE SAL�RIOS', true);
INSERT INTO naturezas VALUES (1254, 'SOLICITA EVOLU��O SALARIAL', true);
INSERT INTO naturezas VALUES (1255, 'DESBLOQUEIO DE VENCIMENTO', true);
INSERT INTO naturezas VALUES (1256, 'RESTITUI��O', true);
INSERT INTO naturezas VALUES (1257, 'SOLICITA��O TRANSFER�NCIA DE COBERTURA', true);
INSERT INTO naturezas VALUES (1258, 'MANDADO DE INTIMA�AO', true);
INSERT INTO naturezas VALUES (1259, 'AUTORIZA��O PARA REALIZA��O DE CONCURSO P�BLICO', true);
INSERT INTO naturezas VALUES (1262, 'ADICIONAL POR TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (1263, 'APRESENTA��O DE IM�VEIS', true);
INSERT INTO naturezas VALUES (1264, 'DESCONTO EM FOLHA', true);
INSERT INTO naturezas VALUES (1265, 'CONSIGNA��O DE DESCONTO (EM FOLHA)', true);
INSERT INTO naturezas VALUES (1267, 'DESAVERBA��O DE LICEN�A ESPECIAL', true);
INSERT INTO naturezas VALUES (1268, 'FERIAS', true);
INSERT INTO naturezas VALUES (1269, 'REINTEGRA��O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (1270, 'AFASTAMENTO DE UM DOS TURNOS', true);
INSERT INTO naturezas VALUES (1271, 'BENS IM�VEIS', true);
INSERT INTO naturezas VALUES (1272, 'BENS M�VEIS', true);
INSERT INTO naturezas VALUES (1273, 'SOLICITA��O DO FGTS', true);
INSERT INTO naturezas VALUES (1275, 'LAUDO M�DICO', true);
INSERT INTO naturezas VALUES (1277, 'RECURSO CONCURSO P�BLICO', true);
INSERT INTO naturezas VALUES (1278, 'MANDADO DE DELIGENCIA', true);
INSERT INTO naturezas VALUES (1279, 'PAGAMENTO DA DIFEREN�A  RETROATIVO SAL�RIO', true);
INSERT INTO naturezas VALUES (1280, 'LEVANTAMENTO FGTS', true);
INSERT INTO naturezas VALUES (1281, 'REVIS�O DE GABARITO DO CONCURSO', true);
INSERT INTO naturezas VALUES (1282, 'PASSAGEM  DE CLASSE', true);
INSERT INTO naturezas VALUES (1284, 'RETROATIVO DO QUINQUENIO', true);
INSERT INTO naturezas VALUES (1285, 'RETROATIVO DO PCC', true);
INSERT INTO naturezas VALUES (1286, 'MANDADO', true);
INSERT INTO naturezas VALUES (1287, 'A��O ORDIN�RIA', true);
INSERT INTO naturezas VALUES (1288, 'MODERNIZA��O', true);
INSERT INTO naturezas VALUES (1289, 'INSTALA��O DE SISTEMA', true);
INSERT INTO naturezas VALUES (1290, 'AUTORIZA��O', true);
INSERT INTO naturezas VALUES (1291, 'PUBLICA��O DE PORTARIA', true);
INSERT INTO naturezas VALUES (1292, 'CRIA��O DE DOM�NIO', true);
INSERT INTO naturezas VALUES (1293, 'DESLIGAMENTO', true);
INSERT INTO naturezas VALUES (1294, 'ALTERA��O DE QDD', true);
INSERT INTO naturezas VALUES (1295, 'HABILITA��O DE APARELHO CELULAR', true);
INSERT INTO naturezas VALUES (1298, 'CONTRATA��O DE T�CNICO', true);
INSERT INTO naturezas VALUES (1299, 'ABONO DE PERMAN�NCIA', true);
INSERT INTO naturezas VALUES (510022, 'FUNDO DA SECRETARIA', true);
INSERT INTO naturezas VALUES (510522, 'FUNDO DO ESPORTE', true);
INSERT INTO naturezas VALUES (510523, 'ENCAMINHANDO BILHETE DE PASSAGEM', true);
INSERT INTO naturezas VALUES (510524, 'AUMENTO DE LINK', true);
INSERT INTO naturezas VALUES (510525, 'HOSPEDEGEM DE SITE', true);
INSERT INTO naturezas VALUES (510526, 'HOSPEDAGEM DE SITE', true);
INSERT INTO naturezas VALUES (510527, 'EMISS�O DE NOTA FISCAL', true);
INSERT INTO naturezas VALUES (510528, 'MUDAN�A DE HOSPEDAGEM DE DOM�NIO', true);
INSERT INTO naturezas VALUES (510529, 'LIBERA��O  DE SERVIDOR', true);
INSERT INTO naturezas VALUES (510530, 'AQUISI��O DE APARELHO CELULAR', true);
INSERT INTO naturezas VALUES (510531, 'ENCAMINHANDO FATURAS', true);
INSERT INTO naturezas VALUES (510532, 'CORRE��O DE CONTRATO', true);
INSERT INTO naturezas VALUES (510533, 'CONTRATA��O DE EMPRESA', true);
INSERT INTO naturezas VALUES (510534, 'BALANCETES', true);
INSERT INTO naturezas VALUES (510537, 'MANUTEN��O DE REDE', true);
INSERT INTO naturezas VALUES (510538, 'CONSERTO DE EQUIPAMENTO', true);
INSERT INTO naturezas VALUES (510539, 'MUDAN�A DE TURNO DE FUNCIONARIOS', true);
INSERT INTO naturezas VALUES (510540, 'MIGRA��O DE SITE', true);
INSERT INTO naturezas VALUES (510542, 'PAGAMENTO DE CURSOS', true);
INSERT INTO naturezas VALUES (510543, 'CONSTRU��O DE GINASIO', true);
INSERT INTO naturezas VALUES (510544, 'AQUISI��O DE EDITAL', true);
INSERT INTO naturezas VALUES (510545, 'RENOVA��O DE EST�GIO', true);
INSERT INTO naturezas VALUES (510546, 'INSTALA��O', true);
INSERT INTO naturezas VALUES (510547, 'RECEBIMENTO DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (510548, 'TARIFAS BANC�RIAS', true);
INSERT INTO naturezas VALUES (510549, 'APROVA��O DE SERVI�OS', true);
INSERT INTO naturezas VALUES (510550, 'PAGAMENTO DE MEDI��O', true);
INSERT INTO naturezas VALUES (510552, 'AVALIA��O DE FUNCION�RIOS', true);
INSERT INTO naturezas VALUES (510553, 'CESS�O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (510554, 'INSCRI��O', true);
INSERT INTO naturezas VALUES (510555, 'PRORROGA��O DE CONTRATO', true);
INSERT INTO naturezas VALUES (510556, 'TERMO ADITIVO', true);
INSERT INTO naturezas VALUES (510557, 'CONTA M�DICA', true);
INSERT INTO naturezas VALUES (510558, 'CONTA ODONTOLOGIA', true);
INSERT INTO naturezas VALUES (510559, 'CONTA FONOAUDIOLOGIA', true);
INSERT INTO naturezas VALUES (510560, 'CONTA PSICOLOGIA', true);
INSERT INTO naturezas VALUES (510561, 'CONTA HOSPITALAR', true);
INSERT INTO naturezas VALUES (510562, 'CONTA LABORAT�RIO', true);
INSERT INTO naturezas VALUES (510563, 'CONTA MATERIAIS M�DICO E HOSPITALARES', true);
INSERT INTO naturezas VALUES (510564, 'CONTA CL�NICA', true);
INSERT INTO naturezas VALUES (510565, 'CONTA AUDITORIA', true);
INSERT INTO naturezas VALUES (510566, 'RESSARCIMENTO DESP. M�DICA', true);
INSERT INTO naturezas VALUES (510567, 'CANCELAMENTO DE SENHA DO PORTAL DO SERVIDOR', true);
INSERT INTO naturezas VALUES (510568, 'ARMA DE FOGO', true);
INSERT INTO naturezas VALUES (510569, 'SOLICITA��O DE DEFESA DE AUTUA��O', true);
INSERT INTO naturezas VALUES (510570, 'SOLICITA��O DE DEFESA DE PENALIDADE', true);
INSERT INTO naturezas VALUES (510571, 'C�PIA DE DOCUMENTO', true);
INSERT INTO naturezas VALUES (510572, 'PAGAMENTO DE ESTAGI�RIO', true);
INSERT INTO naturezas VALUES (510573, 'TRANSFER�NCIA DE PONTOS', true);
INSERT INTO naturezas VALUES (510574, 'RELAT�RIO DE ARRECADA��O', true);
INSERT INTO naturezas VALUES (510575, 'RECOLHIMENTO DE TRIBUTOS', true);
INSERT INTO naturezas VALUES (510576, 'AGRADECIMENTO', true);
INSERT INTO naturezas VALUES (510577, 'CANCELAMENTO CONTRIBUI��O IPASEAL', true);
INSERT INTO naturezas VALUES (510578, 'INCLUS�O NO PROGRAMA DO LEITE', true);
INSERT INTO naturezas VALUES (510579, 'SOLICITA��O DE SEMENTES', true);
INSERT INTO naturezas VALUES (510580, 'MUDAN�A DE CLASSE', true);
INSERT INTO naturezas VALUES (510581, 'FAIXA DE DOM�NIO', true);
INSERT INTO naturezas VALUES (510582, 'CONSTRU��O DE LOMBADA', true);
INSERT INTO naturezas VALUES (510583, 'LICEN�A PR�VIA', true);
INSERT INTO naturezas VALUES (510584, 'LICEN�A DE IMPLANTA��O', true);
INSERT INTO naturezas VALUES (510585, 'LICEN�A DE OPERA��O', true);
INSERT INTO naturezas VALUES (510586, 'LICEN�A DE A.T.P.P.', true);
INSERT INTO naturezas VALUES (510587, 'LICEN�A DE A.T.R.P.', true);
INSERT INTO naturezas VALUES (510588, 'ABONO DE FALTAS', true);
INSERT INTO naturezas VALUES (510589, 'COTA��O DE PRE�O', true);
INSERT INTO naturezas VALUES (510590, 'TERMO', true);
INSERT INTO naturezas VALUES (510591, 'ADIANTAMENTO PARA AQUISI��O DE UNIFORME', true);
INSERT INTO naturezas VALUES (510592, 'REINCLUS�O DE EX-PM  ', true);
INSERT INTO naturezas VALUES (510593, 'DEDU��O DE IMPOSTO DE RENDA', true);
INSERT INTO naturezas VALUES (510594, 'ISEN��O DE IMPOSTO DE RENDA', true);
INSERT INTO naturezas VALUES (510595, 'PROMO��O POS-MORTEM', true);
INSERT INTO naturezas VALUES (510596, 'PROMO��O POR ATO DE BRAVURA', true);
INSERT INTO naturezas VALUES (510597, 'COMPENSA��O FINANCEIRA', true);
INSERT INTO naturezas VALUES (510598, 'ABERTURA DO ISO', true);
INSERT INTO naturezas VALUES (510599, 'PROMO��O POR TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (510600, 'REFORMA DE PM', true);
INSERT INTO naturezas VALUES (510601, 'TRANSFER�NCIA PARA RESERVA REMUNERADA', true);
INSERT INTO naturezas VALUES (510603, 'TERMO DE AJUSTE DE CONDUTA-TAC', true);
INSERT INTO naturezas VALUES (510604, 'LICENCIAMENTO', true);
INSERT INTO naturezas VALUES (510605, 'RENOVA��O DE A.T.P.P', true);
INSERT INTO naturezas VALUES (510606, 'RENOVA��O DE A.T.R.P.', true);
INSERT INTO naturezas VALUES (510607, 'RENOVA��O DA LICEN�A DE OPERA��O', true);
INSERT INTO naturezas VALUES (510608, 'APRESENTA DEFESA', true);
INSERT INTO naturezas VALUES (510609, 'PRORROGA��O DE PRAZO', true);
INSERT INTO naturezas VALUES (510610, 'PAGAMENTO DE REEDUCANDOS', true);
INSERT INTO naturezas VALUES (510611, 'PAGAMENTO SERVI�OS FUNER�RIOS', true);
INSERT INTO naturezas VALUES (510612, 'PAGAMENTO DE REFEI��ES', true);
INSERT INTO naturezas VALUES (510613, 'COMPRA DE ALIMENTOS', true);
INSERT INTO naturezas VALUES (510614, 'TRANSFER�NCIA PARA RESERVA REMUNERADA EX-OFF�CIO', true);
INSERT INTO naturezas VALUES (510615, 'PAGAMENTO PRESTADORES DE SERVI�OS/SAP', true);
INSERT INTO naturezas VALUES (510616, 'COMPRA DE �GUA MINERAL', true);
INSERT INTO naturezas VALUES (510617, 'SOLICITA��O DE OUTORGA DE DIREITO DE USO DE �GUA', true);
INSERT INTO naturezas VALUES (510618, 'SOLICITA��O DE RENOVA��O DE OUTORGA DE USO DA �GUA', true);
INSERT INTO naturezas VALUES (510619, 'CERTID�O', true);
INSERT INTO naturezas VALUES (510620, 'CERTIFICADO DE VISTORIA', true);
INSERT INTO naturezas VALUES (510621, 'MEDI��O', true);
INSERT INTO naturezas VALUES (510622, 'FISCALIZA��O DE EMPRENDIMENTO', true);
INSERT INTO naturezas VALUES (510623, 'DEFESA DE MULTA', true);
INSERT INTO naturezas VALUES (510624, 'LIBERA��O DE DOCUMENTO NO DETRAN', true);
INSERT INTO naturezas VALUES (510625, 'INCLUS�O DE VE�CULO NOVO', true);
INSERT INTO naturezas VALUES (510626, 'TRANSFER�NCIA DE VE�CULO', true);
INSERT INTO naturezas VALUES (510627, 'REQUERIMENTO ESPECIAL', true);
INSERT INTO naturezas VALUES (510628, 'SOLICITA��O DE FRETAMENTO', true);
INSERT INTO naturezas VALUES (510629, 'SOLICITA��O DE MOTORISTA SUBSTITUTO', true);
INSERT INTO naturezas VALUES (510630, 'TERMO DE INSTALA��O DE SINDIC�NCIA ADMINISTRATIVA', true);
INSERT INTO naturezas VALUES (510631, 'C�PIA DE PROCESSO(S)', true);
INSERT INTO naturezas VALUES (510632, 'SOLICITA��O DE DIPLOMA', true);
INSERT INTO naturezas VALUES (510633, 'AMARELINHAS DETRAN', true);
INSERT INTO naturezas VALUES (510634, 'PRESTA��O DE SERVI�OS', true);
INSERT INTO naturezas VALUES (510635, 'REDUTOR DE VELOCIDADE', true);
INSERT INTO naturezas VALUES (510636, 'RECUPERA��O DE RODOVIAS', true);
INSERT INTO naturezas VALUES (510637, 'PAGAMENTO DE ALUGUEL', true);
INSERT INTO naturezas VALUES (510638, 'EXPEDI��O DE IDENTIDADE POLICIAL', true);
INSERT INTO naturezas VALUES (510639, 'INQU�RITO', true);
INSERT INTO naturezas VALUES (510640, 'INFORMA��ES SOBRE RODOVIAS', true);
INSERT INTO naturezas VALUES (510641, 'PUBLICA��O NO DI�RIO OFICIAL', true);
INSERT INTO naturezas VALUES (510642, '510526-PAGAMENTO', true);
INSERT INTO naturezas VALUES (510643, '510024-PAGAMENTO', true);
INSERT INTO naturezas VALUES (510644, '510024-SERVI�OS DE TERCEIROS/PF', true);
INSERT INTO naturezas VALUES (510645, '510024-SERVI�OS DE TERCEIROS/PJ', true);
INSERT INTO naturezas VALUES (510646, '510526-SERVI�OS DE TERCEIROS/PF', true);
INSERT INTO naturezas VALUES (510647, '510526-SERVI�OS DE TERCEIROS/PJ', true);
INSERT INTO naturezas VALUES (510648, '510024- PASSAGEM(NS)', true);
INSERT INTO naturezas VALUES (510649, '510526-PASSAGEM(NS)', true);
INSERT INTO naturezas VALUES (510650, '510024-MATERIAL PERMANENTE', true);
INSERT INTO naturezas VALUES (510651, '510526-MATERIAL PERMANENTE', true);
INSERT INTO naturezas VALUES (510652, '510526-PRESTA��O DE CONTAS DE ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (510653, '510024-SOLICITA��O DE ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (510654, '510526-SOLICITA��O DE ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (510655, '510024-SOLICITA��O DE MANUTEN��O', true);
INSERT INTO naturezas VALUES (510656, '510526-SOLICITA��O DE MANUTEN��O', true);
INSERT INTO naturezas VALUES (510657, '510024-AQUISI��O DE MATERIAIS', true);
INSERT INTO naturezas VALUES (510658, '510526-AQUISI��O DE MATERIAIS', true);
INSERT INTO naturezas VALUES (510659, '510024-DI�RIA(S)', true);
INSERT INTO naturezas VALUES (510660, '510526-DI�RIA(S)', true);
INSERT INTO naturezas VALUES (510661, 'DIARIAS/CUSTEIO', true);
INSERT INTO naturezas VALUES (510662, 'INDENIZA��O POR DANOS MORAIS', true);
INSERT INTO naturezas VALUES (510663, 'INDENIZA��O', true);
INSERT INTO naturezas VALUES (510664, 'LICEN�A PARA OBRAS H�DRICAS', true);
INSERT INTO naturezas VALUES (510665, 'ISEN��O DE OUTORGA DE DIREITO DO USO DA �GUA ', true);
INSERT INTO naturezas VALUES (510666, 'RECURSO DE IMPOSI��O DE PENALIDADE - NIP', true);
INSERT INTO naturezas VALUES (510667, 'RESPOSTA A OF�CIO', true);
INSERT INTO naturezas VALUES (510668, 'DEN�NCIA DE IRREGULARIDADES', true);
INSERT INTO naturezas VALUES (510669, 'ESCALA DE F�RIAS', true);
INSERT INTO naturezas VALUES (510670, 'PROJETO(S)', true);
INSERT INTO naturezas VALUES (510671, '510024-ADICIONAL NOTURNO', true);
INSERT INTO naturezas VALUES (510672, '510526-ADICIONAL NOTURNO', true);
INSERT INTO naturezas VALUES (510673, '510024-COTA��O DE PRE�O', true);
INSERT INTO naturezas VALUES (510674, '510526-COTA��O DE PRE�O', true);
INSERT INTO naturezas VALUES (510675, 'TODOS OS DIREITOS', true);
INSERT INTO naturezas VALUES (510676, 'ABASTECIMENTO DE AGUA', true);
INSERT INTO naturezas VALUES (510677, 'RECURSO ADMINISTRATIVO', true);
INSERT INTO naturezas VALUES (510678, 'EMPENHO DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (510679, 'C�PIA DE INDICA��O', true);
INSERT INTO naturezas VALUES (510680, 'C�PIA DE FICHA', true);
INSERT INTO naturezas VALUES (510681, 'SOLICITA��O DE D�BITO', true);
INSERT INTO naturezas VALUES (510682, 'SERVI�OS DE TERCEIROS/PF', true);
INSERT INTO naturezas VALUES (510683, 'REAJUSTE DE CONTRATO', true);
INSERT INTO naturezas VALUES (510684, 'REAJUSTE DE PRE�O', true);
INSERT INTO naturezas VALUES (510685, 'TRANSFER�NCIA PARA RESERVA REMUNERADA', true);
INSERT INTO naturezas VALUES (510686, 'COMPRA DE VALE TRANSPORTE', true);
INSERT INTO naturezas VALUES (510687, 'AQUISI��O DE ALIMENTOS PARA ACAMPADOS', true);
INSERT INTO naturezas VALUES (510688, 'AQUISI��O DE LONA', true);
INSERT INTO naturezas VALUES (510689, 'SERVI�OS T�CNICOS DE VISTORIA', true);
INSERT INTO naturezas VALUES (510690, 'SERVI�OS T�CNICOS DE DEMARCA��O', true);
INSERT INTO naturezas VALUES (510691, 'SERVI�OS T�CNICOS DE PACELAMENTO', true);
INSERT INTO naturezas VALUES (510692, '510024-PRESTA��O DE CONTAS', true);
INSERT INTO naturezas VALUES (510693, '510526-PRESTA��O DE CONTAS', true);
INSERT INTO naturezas VALUES (510694, '510024-AVERBA��O POR TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (510695, '510024-CERTID�O', true);
INSERT INTO naturezas VALUES (510696, 'SERVI�OS T�CNICOS DE PACELAMENTO', true);
INSERT INTO naturezas VALUES (510697, 'SERVI�OS T�C. DE REVIS�O DE LIMITES TERRITORIAIS', true);
INSERT INTO naturezas VALUES (510698, 'SERVI�OS T�CNICOS DE AVALIA��O', true);
INSERT INTO naturezas VALUES (510699, 'SERVI�OS T�CNICOS DE CADASTRO DE IM�VEIS RURAIS', true);
INSERT INTO naturezas VALUES (510700, 'APOIO A FAM�LIAS ACAMPADAS - DOA��O DE ALIMENTOS', true);
INSERT INTO naturezas VALUES (510701, 'APOIO A FAM�LIAS ACAMPADAS - SANIT�RIO QU�MICO', true);
INSERT INTO naturezas VALUES (510702, 'APOIO A FAM�LIAS ACAMPADAS - DOA��O DE CAMISA', true);
INSERT INTO naturezas VALUES (510704, 'APOIO A FAM�LIAS ACAMPADAS - DOA��O DE LONA', true);
INSERT INTO naturezas VALUES (510705, 'LOC. DE �NIBUS - TRANSPORTE TRABALHADORES RURAIS', true);
INSERT INTO naturezas VALUES (510706, 'APOIO A EVENTOS DE COMUNIDADES ASSISTIDAS', true);
INSERT INTO naturezas VALUES (510708, 'CONTRATO DE LOCA��O DE IM�VEL - NFRF', true);
INSERT INTO naturezas VALUES (510709, 'CONTRATO DE LOCA��O DE IM�VEL - NFRPI', true);
INSERT INTO naturezas VALUES (510710, 'CONTRATO DE LOCA��O DE IM�VEL - NFRMG', true);
INSERT INTO naturezas VALUES (510711, 'CONTRATO DE LOCA��O DE IM�VEL - NFRSI', true);
INSERT INTO naturezas VALUES (510712, 'CONTRATO DE LOCA��O DE VE�CULO', true);
INSERT INTO naturezas VALUES (510713, 'EMISS�O DE T�TULO DE TERRA', true);
INSERT INTO naturezas VALUES (510714, 'OF�CIO', true);
INSERT INTO naturezas VALUES (510715, 'A��O DECLARAT�RIA', true);
INSERT INTO naturezas VALUES (510716, 'CARTA DE SENTE�A', true);
INSERT INTO naturezas VALUES (510717, 'CARTA DE FIAN�A BANC�RIA', true);
INSERT INTO naturezas VALUES (510718, 'CAU��O', true);
INSERT INTO naturezas VALUES (510719, 'VIS�TA T�CNICA', true);
INSERT INTO naturezas VALUES (510720, 'CONCILIA��O BANC�RIA ', true);
INSERT INTO naturezas VALUES (510721, 'DEFESA', true);
INSERT INTO naturezas VALUES (510722, 'AQUISI��O DE PE�AS E SERVI�OS PARA VE�CULOS', true);
INSERT INTO naturezas VALUES (510723, 'CONTRATA��O DE AERONAVE(S)', true);
INSERT INTO naturezas VALUES (510724, 'AQUISI��O DE �LEOS E LUBRIFICANTES', true);
INSERT INTO naturezas VALUES (510725, 'PROGRESS�O POR NOVA HABILITA��O', true);
INSERT INTO naturezas VALUES (510726, 'PAGAMENTO DE TRANSPORTE', true);
INSERT INTO naturezas VALUES (510727, 'CONTRATA��O DE HELIC�PTERO', true);
INSERT INTO naturezas VALUES (510728, 'LOCA��O DE HELIC�PTERO', true);
INSERT INTO naturezas VALUES (510729, 'PAGAMENTO DE LOCA��O DE VE�CULO', true);
INSERT INTO naturezas VALUES (510730, 'PAGAMENTO DE LOCA��O DE AERONAVE', true);
INSERT INTO naturezas VALUES (510731, 'PAGAMENTO DE LOCA��O DE HELIC�PTERO', true);
INSERT INTO naturezas VALUES (510732, 'VAC�NCIA', true);
INSERT INTO naturezas VALUES (510733, ' PAGAMENTO DE �GUA', true);
INSERT INTO naturezas VALUES (510734, 'PAGAMENTO DE ENERGIA', true);
INSERT INTO naturezas VALUES (510735, 'PAGAMENTO DE CONTA TELEF�NICA', true);
INSERT INTO naturezas VALUES (510736, 'LIBERA��O DE RECURSOS', true);
INSERT INTO naturezas VALUES (510737, 'AQUISI��O DE G�NEROS ALIMENT�CIOS', true);
INSERT INTO naturezas VALUES (510738, 'PAGAMENTO DE FATURA', true);
INSERT INTO naturezas VALUES (510739, 'PAGAMENTO DE TAXA', true);
INSERT INTO naturezas VALUES (510740, 'AFASTAMENTO PARA CONCORRER ELEI��O', true);
INSERT INTO naturezas VALUES (510741, 'DIF�CIL ACESSO', true);
INSERT INTO naturezas VALUES (510742, 'SOLICITA��O DE ADEQUA��O', true);
INSERT INTO naturezas VALUES (510743, 'REFORMA ESCOLAR', true);
INSERT INTO naturezas VALUES (510744, 'SOLICITA CONSTRU��O', true);
INSERT INTO naturezas VALUES (510745, 'SOLICITA AN�LISE E PARECER', true);
INSERT INTO naturezas VALUES (510746, 'VAC�NCIA DO CARGO', true);
INSERT INTO naturezas VALUES (510747, 'COLABORA��O EM EVENTO', true);
INSERT INTO naturezas VALUES (510748, 'FORNECIMENTO DE ALIMENTA��O', true);
INSERT INTO naturezas VALUES (510749, 'SOLICITA PATROCIN�O', true);
INSERT INTO naturezas VALUES (510750, 'RENOVA��O DE CONV�NIO', true);
INSERT INTO naturezas VALUES (510751, 'PARECER JUR�DICO', true);
INSERT INTO naturezas VALUES (510752, 'INTERPOSI��O DE RECURSOS', true);
INSERT INTO naturezas VALUES (510753, 'PAGAMENTO DE EMPRESA', true);
INSERT INTO naturezas VALUES (510754, 'PAGAMENTO DE SUBSTITUI��O', true);
INSERT INTO naturezas VALUES (510755, 'AUX�LIO TRANSPORTE E OU ALIMENTA��O', true);
INSERT INTO naturezas VALUES (510756, 'RESCIS�O DE CONTRATO', true);
INSERT INTO naturezas VALUES (510757, 'COMUNICA��O DE SERVIDOR SEM FREQ��NCIA', true);
INSERT INTO naturezas VALUES (510758, 'SOLICITA HIST�RICO ESCOLAR', true);
INSERT INTO naturezas VALUES (510759, 'CONCESS�O DE CURSO', true);
INSERT INTO naturezas VALUES (510760, 'AQUISI��O DE MATERIAL ESCOLAR', true);
INSERT INTO naturezas VALUES (510761, 'CONFEC��O DE MATERIAL', true);
INSERT INTO naturezas VALUES (510762, 'ABERTURA DE PROCESSO LICITAT�RIO', true);
INSERT INTO naturezas VALUES (510763, 'SOLICITA ESPA�O F�SICO', true);
INSERT INTO naturezas VALUES (510764, 'ENCAMINHA ATAS', true);
INSERT INTO naturezas VALUES (510765, 'PREENCHIMENTO DE DOCUMENTO', true);
INSERT INTO naturezas VALUES (510766, 'PAGAMENTO DE FOLHA SUPLEMENTAR', true);
INSERT INTO naturezas VALUES (510767, 'APURA��O DOS FATOS', true);
INSERT INTO naturezas VALUES (510768, 'PROVID�NCIAS REFERENTE A REASSUN��O', true);
INSERT INTO naturezas VALUES (510769, 'COMUNICA SITUA��O DE SERVIDOR', true);
INSERT INTO naturezas VALUES (510770, 'INFORMA CAR�NCIA DE SERVIDOR(ES)', true);
INSERT INTO naturezas VALUES (510771, 'LIBERA��O DE TRANSPORTE PARA EVENTO(S)', true);
INSERT INTO naturezas VALUES (510773, 'PAGAMENTO DE PROFISSIONAL', true);
INSERT INTO naturezas VALUES (510774, 'PAGAMENTO DE INDENIZA��O', true);
INSERT INTO naturezas VALUES (193, '193 - SOLICITA��O', true);
INSERT INTO naturezas VALUES (510775, 'BAIXA DE ALMOXARIFADO', true);
INSERT INTO naturezas VALUES (510776, 'AQUISI��O DE MOV�IS', true);
INSERT INTO naturezas VALUES (510777, 'PROCESSO AQUISITIVO', true);
INSERT INTO naturezas VALUES (510778, 'PROCESSO ADMINISTRATIVO', true);
INSERT INTO naturezas VALUES (510779, 'PROCESSO PERMI��O DE USO', true);
INSERT INTO naturezas VALUES (510780, 'SOLICITA��O DE SERVI�O(S)', true);
INSERT INTO naturezas VALUES (510781, 'A��O COMUNIT�RIA', true);
INSERT INTO naturezas VALUES (510782, 'CERTID�O NEGATIVA', true);
INSERT INTO naturezas VALUES (510783, 'CERTID�O POSITIVA COM EFEITO NEGATIVA', true);
INSERT INTO naturezas VALUES (510784, 'A��O DE EXECU��O FISCAL', true);
INSERT INTO naturezas VALUES (510707, 'LOCA��O DE EQUIPAMENTO(S)', true);
INSERT INTO naturezas VALUES (510785, 'EXTIN��O DA EXECU��O FISCAL', true);
INSERT INTO naturezas VALUES (510786, 'INTERPOSI��O AO AGRAVO DE INSTRUMENTO', true);
INSERT INTO naturezas VALUES (510787, 'A��O COMINAT�RIA', true);
INSERT INTO naturezas VALUES (510788, 'RAZ�ES DE N�O RECORRER', true);
INSERT INTO naturezas VALUES (510789, 'DISPENSA PARA RECUSAR', true);
INSERT INTO naturezas VALUES (510790, 'AGRAVO DE PETI��O EM EXECU��O', true);
INSERT INTO naturezas VALUES (510791, 'A��O CIVIL P�BLICA', true);
INSERT INTO naturezas VALUES (510792, 'CARTA PRECAT�RIA CIVEL', true);
INSERT INTO naturezas VALUES (36, 'DISPENSA E DESIGNA��O DE DIRETOR', true);
INSERT INTO naturezas VALUES (510772, 'CONTRATA��O DE PROFISSIONAL(IS) E OU  MONITOR(ES)', true);
INSERT INTO naturezas VALUES (510793, 'PROCESSO JUDICIAL', true);
INSERT INTO naturezas VALUES (510794, 'SOLICITA PUBLICA��O', true);
INSERT INTO naturezas VALUES (510795, 'ADICIONAL NOTURNO                                ', false);
INSERT INTO naturezas VALUES (510799, 'AQUISI��O DE IMPRESSORA                          ', false);
INSERT INTO naturezas VALUES (510800, 'AQUISI��O DE MATERIAL                            ', false);
INSERT INTO naturezas VALUES (510802, 'ASSUNTOS JUDICIAIS                               ', false);
INSERT INTO naturezas VALUES (510833, 'CONV�NIO                                         ', false);
INSERT INTO naturezas VALUES (510845, 'EXAME DE LEGISLACAO                              ', false);
INSERT INTO naturezas VALUES (510846, 'EXONERACAO                                       ', false);
INSERT INTO naturezas VALUES (510859, 'LOCACAO DE EQUIPAMENTO                           ', false);
INSERT INTO naturezas VALUES (510860, 'LOCACAO DE IMOVEL                                ', false);
INSERT INTO naturezas VALUES (510861, 'LOCACAO DE VEICULO                               ', false);
INSERT INTO naturezas VALUES (510863, 'MUDANCA DE CLASSE                                ', false);
INSERT INTO naturezas VALUES (510867, 'OFICIO                                           ', false);
INSERT INTO naturezas VALUES (510873, 'PODER JUDICIARIO                                 ', false);
INSERT INTO naturezas VALUES (510874, 'PRESTACAO DE CONTAS                              ', false);
INSERT INTO naturezas VALUES (510797, 'APREENSAO DE CNH                                 ', true);
INSERT INTO naturezas VALUES (510798, 'AQUISI��O DE COMPUTADORES E IMPRESSORAS          ', true);
INSERT INTO naturezas VALUES (510801, 'ASSUNTOS DIVERSOS                                ', true);
INSERT INTO naturezas VALUES (510827, 'CNH APREENDIDA                                   ', true);
INSERT INTO naturezas VALUES (510804, 'AUDI�NCIA DE CONCILIA��O                         ', true);
INSERT INTO naturezas VALUES (510808, 'AUTORIZA��O DE MATERIAL                          ', true);
INSERT INTO naturezas VALUES (510826, 'CLONAGEM DE VEICULO                              ', true);
INSERT INTO naturezas VALUES (510809, 'AUTORIZA��O DE PAGAMENTO                         ', true);
INSERT INTO naturezas VALUES (510810, 'AUTORIZA��O PARA CURSO                           ', true);
INSERT INTO naturezas VALUES (510811, 'AUTORIZA��O PARA SERVI�OS                        ', true);
INSERT INTO naturezas VALUES (510830, 'CONTRATACAO DE GUINCHO                           ', true);
INSERT INTO naturezas VALUES (510805, 'AUTORIZA��O PARA SERVI�OS COM AQUISI��O DE PE�AS ', true);
INSERT INTO naturezas VALUES (510803, 'ASSUNTOS JUDICI�RIOS                             ', true);
INSERT INTO naturezas VALUES (510831, 'CONTRATACAO DE SERVI�OS                          ', true);
INSERT INTO naturezas VALUES (510832, 'CONTRATO DE LOCA��O DE IM�VEL                    ', true);
INSERT INTO naturezas VALUES (510812, 'BAIXA DE MULTA                                   ', true);
INSERT INTO naturezas VALUES (510813, 'BAIXA DE VE�CULO                                 ', true);
INSERT INTO naturezas VALUES (510816, 'CADASTRO DE PGU                                  ', true);
INSERT INTO naturezas VALUES (510834, 'CORRE��O DE CNH                                  ', true);
INSERT INTO naturezas VALUES (510814, 'BLOQUEIO DE VE�CULO                              ', true);
INSERT INTO naturezas VALUES (510815, 'BOLETIM DE OCORR�NCIA                            ', true);
INSERT INTO naturezas VALUES (510817, 'CANCELAMENTO DE INFRA��O                         ', true);
INSERT INTO naturezas VALUES (510818, 'CANCELAMENTO DE SENHA                            ', true);
INSERT INTO naturezas VALUES (510828, 'CONFEC��O DE PANFLETOS                           ', true);
INSERT INTO naturezas VALUES (510829, 'CONSTRUCAO DE UM POSTO/CIRETRANS                 ', true);
INSERT INTO naturezas VALUES (510819, 'CANCELAMENTO PENHORA REGISTRO DE VE�CULO         ', true);
INSERT INTO naturezas VALUES (510839, 'DESBLOQUEIO DE VE�CULO                           ', true);
INSERT INTO naturezas VALUES (510836, 'CURSO CETRAN                                     ', true);
INSERT INTO naturezas VALUES (510840, 'DESIST�NCIA DE CATEGORIA                         ', true);
INSERT INTO naturezas VALUES (510837, 'DEFESA ADMINISTRATIVA                            ', true);
INSERT INTO naturezas VALUES (510838, 'DEFESA PR�VIA                                    ', true);
INSERT INTO naturezas VALUES (510841, 'DUPLICIDADE DE PGU                               ', true);
INSERT INTO naturezas VALUES (510842, 'EFEITO SUSPENSIVO DE INFRACAO                    ', true);
INSERT INTO naturezas VALUES (510843, 'ENCAMINHAMENTO DE DOCUMENTOS                     ', true);
INSERT INTO naturezas VALUES (510847, 'FATURAMENTO DE CNH                               ', true);
INSERT INTO naturezas VALUES (510844, 'EXAME DE DIRECAO VEICULAR                        ', true);
INSERT INTO naturezas VALUES (510848, 'FATURAS DE SERVI�OS                              ', true);
INSERT INTO naturezas VALUES (510849, 'IMPEDIMENTO PREVENTIVO                           ', true);
INSERT INTO naturezas VALUES (510850, 'INDENIZACAO E RESSARCIMENTO                      ', true);
INSERT INTO naturezas VALUES (510852, 'INSCRICAO EM CONGRESSO                           ', true);
INSERT INTO naturezas VALUES (510851, 'INFORMACAO DE VENDA DE VEICULO                   ', true);
INSERT INTO naturezas VALUES (510853, 'INTERDICAO DE VIAS DE TRANSITO                   ', true);
INSERT INTO naturezas VALUES (510858, 'LICITACAO DE EQUIPAMENTOS                        ', true);
INSERT INTO naturezas VALUES (510854, 'JUNTA MEDICA                                     ', true);
INSERT INTO naturezas VALUES (510855, 'JUNTA PSICOLOGICA                                ', true);
INSERT INTO naturezas VALUES (510856, 'LIBERACAO DE VIAS DE TRANSITO                    ', true);
INSERT INTO naturezas VALUES (510857, 'LIBERA�AO DE PENHORA                             ', true);
INSERT INTO naturezas VALUES (510862, 'MANDADO DE PENHORA E AVALIACAO                   ', true);
INSERT INTO naturezas VALUES (510866, 'MUNICIPALIZACAO DO TRANSITO                      ', true);
INSERT INTO naturezas VALUES (510865, 'MUDANCA DE SERVI�O                               ', true);
INSERT INTO naturezas VALUES (510864, 'MUDANCA DE ENDERE�O                              ', true);
INSERT INTO naturezas VALUES (510868, 'ORCAMENTO DE MANUTENCAO                          ', true);
INSERT INTO naturezas VALUES (510870, 'PEDIDO DE AQUISI�AO DE VEICULO                   ', true);
INSERT INTO naturezas VALUES (510869, 'ORCAMENTO MENSAL                                 ', true);
INSERT INTO naturezas VALUES (510871, 'PENHORA NO REGISTRO DE VEICULO                   ', true);
INSERT INTO naturezas VALUES (510877, 'REABILITACAO                                     ', true);
INSERT INTO naturezas VALUES (510872, 'PERICIA MEDICA DO INSS                           ', true);
INSERT INTO naturezas VALUES (510878, 'RECLAMACAO TRABALHISTA                           ', true);
INSERT INTO naturezas VALUES (510875, 'PRESTA�AO DE CONTAS DE DIARIAS                   ', true);
INSERT INTO naturezas VALUES (510876, 'PRODU��O INTERNA                                 ', true);
INSERT INTO naturezas VALUES (510991, 'COMPRA EMERGENCIAL ', true);
INSERT INTO naturezas VALUES (510879, 'RECURSO ADMINISTRATIVO                           ', false);
INSERT INTO naturezas VALUES (510887, 'RESSARCIMENTO                                    ', false);
INSERT INTO naturezas VALUES (510894, 'SOLICITA��O DE IPVA PROPORCIONAL                 ', false);
INSERT INTO naturezas VALUES (510895, 'SOLICITA��O DE MATERIAL                          ', false);
INSERT INTO naturezas VALUES (510898, 'SOLICITA��O DE SERVICOS                          ', false);
INSERT INTO naturezas VALUES (510899, 'SOLICITA��O DE SERVI�OS                           ', false);
INSERT INTO naturezas VALUES (510906, 'SOLICITA��O DE IPVA PROPORCIONAL                 ', false);
INSERT INTO naturezas VALUES (510907, 'SOLICITA��ES EM GERAL                            ', false);
INSERT INTO naturezas VALUES (510796, 'ALTERACAO DE BOLETIM DE OCORR�NCIA               ', true);
INSERT INTO naturezas VALUES (510820, 'CERTID�O DE ISENCAO DE IPVA                      ', true);
INSERT INTO naturezas VALUES (510821, 'CERTID�O DE PROPRIEDADE DE VEICULO               ', true);
INSERT INTO naturezas VALUES (510806, 'AUTORIZA��O DE ADIANTAMENTO                      ', true);
INSERT INTO naturezas VALUES (510822, 'CERTID�O DE SERVI�O PRESTADO                     ', true);
INSERT INTO naturezas VALUES (510823, 'CERTID�O DIVERSAS                                 ', true);
INSERT INTO naturezas VALUES (510807, 'AUTORIZA��O DE DI�RIAS                           ', true);
INSERT INTO naturezas VALUES (510824, 'CERTID�O PARA EMPR�STIMO COMPULS�RIO             ', true);
INSERT INTO naturezas VALUES (510825, 'CERTID�O PARA FINS DE SEGURO                     ', true);
INSERT INTO naturezas VALUES (510882, 'REGISTRO DE VEICULOS-INFORMACOES                 ', true);
INSERT INTO naturezas VALUES (510881, 'RECURSO DE MULTAS                                ', true);
INSERT INTO naturezas VALUES (510880, 'RECURSO AO CETRAN                                ', true);
INSERT INTO naturezas VALUES (510886, 'REQUERIMENTO CNH                                 ', true);
INSERT INTO naturezas VALUES (510883, 'RENOVACAO DE CONTRATO DE IMOVEIS                 ', true);
INSERT INTO naturezas VALUES (510884, 'RENOVACAO DE CONVENIO                            ', true);
INSERT INTO naturezas VALUES (510885, 'RENOVACAO DE ESTAGIO                             ', true);
INSERT INTO naturezas VALUES (510902, 'SOLICITA��O DE ADIANTAMENTO                      ', true);
INSERT INTO naturezas VALUES (510889, 'SOLICITA��O DE CAMISAS                           ', true);
INSERT INTO naturezas VALUES (510896, 'SOLICITA��O DE PAGAMENTO                         ', true);
INSERT INTO naturezas VALUES (510890, 'SOLICITA��O DE CERTIDAO                          ', true);
INSERT INTO naturezas VALUES (510897, 'SOLICITA��O DE SENHAS DE ACESSO                  ', true);
INSERT INTO naturezas VALUES (510888, 'SOLICITA��O DE CERTIDAO ISEN�AO IOF              ', true);
INSERT INTO naturezas VALUES (510903, 'SOLICITA��O DE COMPUTADORES                      ', true);
INSERT INTO naturezas VALUES (510891, 'SOLICITA��O DE COPIA DE AUTO DE INFRACAO         ', true);
INSERT INTO naturezas VALUES (510900, 'SOLICITA��O POLICIAMENTO DE TRANSITO             ', true);
INSERT INTO naturezas VALUES (510908, 'SOLICITA��O DE ESTAGI�RIOS                       ', true);
INSERT INTO naturezas VALUES (510892, 'SOLICITA��O DE DIARIAS                           ', true);
INSERT INTO naturezas VALUES (510901, 'SOLICITA��O REF. HABILITACAO CNH                 ', true);
INSERT INTO naturezas VALUES (510893, 'SOLICITA��O DE EST�GIO                           ', true);
INSERT INTO naturezas VALUES (510904, 'SOLICITA��O DE FARDAMENTOS                       ', true);
INSERT INTO naturezas VALUES (510909, 'SUSPENS�O DE CNH                                 ', true);
INSERT INTO naturezas VALUES (510910, 'SUSPENS�O DO DIREITO DE DIRIGIR                  ', true);
INSERT INTO naturezas VALUES (510905, 'SOLICITA��O DE HORAS EXTRAS                      ', true);
INSERT INTO naturezas VALUES (510911, 'TRANSFERENCIA DE PONTUA��O                       ', false);
INSERT INTO naturezas VALUES (510912, 'SOLICITA��O DE IPVA PROPORCIONAL', true);
INSERT INTO naturezas VALUES (510913, 'CARTA DE CITA��O/INTIMA��O', true);
INSERT INTO naturezas VALUES (510914, 'LOCA��O DE R�DIOS TRANSCEPTORES', true);
INSERT INTO naturezas VALUES (510915, 'COBRAN�A DE INFRA��O DE TR�NSITO', true);
INSERT INTO naturezas VALUES (510916, 'AQUISI��O DE IMPRESSORAS', true);
INSERT INTO naturezas VALUES (510917, 'LOCA��O DE AERONAVES', true);
INSERT INTO naturezas VALUES (510918, 'AQUISI��O DE ADESIVOS', true);
INSERT INTO naturezas VALUES (510919, 'PAGAMENTO DE LICENCIAMENTO DE VE�CULOS', true);
INSERT INTO naturezas VALUES (510920, 'DISPENSA E DESIGNA��O DE MILITARES', true);
INSERT INTO naturezas VALUES (510921, 'AJUDA DE CUSTOS', true);
INSERT INTO naturezas VALUES (510922, 'MEDICAMENTOS DE ALTO CUSTO', true);
INSERT INTO naturezas VALUES (510923, 'INCENTIVO DE QUALIFICA��O PROFISSIONAL', true);
INSERT INTO naturezas VALUES (510924, 'LICEN�A PR�MIO EM DOBRO', true);
INSERT INTO naturezas VALUES (510925, 'LICEN�A ESPECIAL', true);
INSERT INTO naturezas VALUES (510926, 'AVERBA��O DE TEMPO DE SERVI�O', true);
INSERT INTO naturezas VALUES (510927, 'INCORPORA��O DO PERCENTUAL DE GRATIFICA��O', true);
INSERT INTO naturezas VALUES (510928, 'LIBERA��O DO FGTS', true);
INSERT INTO naturezas VALUES (510929, 'PREVIS�O OR�AMENT�RIA', true);
INSERT INTO naturezas VALUES (510930, 'VIAGEM A�REA', true);
INSERT INTO naturezas VALUES (510931, 'TRANSFER�NCIA', true);
INSERT INTO naturezas VALUES (510932, 'PAGAMENTO DIVERSOS', true);
INSERT INTO naturezas VALUES (510933, 'APOSENTADORIA', true);
INSERT INTO naturezas VALUES (510934, 'COMPLEMENTA��O DE CARGA HOR�RIA', true);
INSERT INTO naturezas VALUES (510935, 'REDISTRIBUI��O', true);
INSERT INTO naturezas VALUES (510936, 'PRODUTIVIDADE', true);
INSERT INTO naturezas VALUES (510937, 'MATERIAL PERMANENTE', true);
INSERT INTO naturezas VALUES (510938, 'RELAT�RIO DE FISCALIZA��O', true);
INSERT INTO naturezas VALUES (510939, 'PROGRAMA��O PACTUADA INTEGRADA - PPI', true);
INSERT INTO naturezas VALUES (510940, 'LIBERA��O DE PARCELA, REFERENTE A CONV�NIO', true);
INSERT INTO naturezas VALUES (510941, 'PRESTA��O DE CONTAS DE CONV�NIO', true);
INSERT INTO naturezas VALUES (510942, 'IMPLANTA��O DE PROGRAMAS', true);
INSERT INTO naturezas VALUES (510943, 'INTERIORIZA��O', true);
INSERT INTO naturezas VALUES (510944, 'CADASTRAMENTO DO SIA/SUS', true);
INSERT INTO naturezas VALUES (510945, 'EXONERA��O', true);
INSERT INTO naturezas VALUES (510946, 'CONCORR�NCIA P�BLICA NORMAL', true);
INSERT INTO naturezas VALUES (510947, 'ENQUADRAMENTO', true);
INSERT INTO naturezas VALUES (510948, 'LICEN�A SEM VENCIMENTOS', true);
INSERT INTO naturezas VALUES (510949, 'INSALUBRIDADE', true);
INSERT INTO naturezas VALUES (510950, 'IMPANTA��O DE TETO FINANCEIRO', true);
INSERT INTO naturezas VALUES (510951, 'RESSARCIMENTO', true);
INSERT INTO naturezas VALUES (510952, 'PERMAN�NCIA DE SERVIDOR', true);
INSERT INTO naturezas VALUES (510953, 'DI�RIAS', true);
INSERT INTO naturezas VALUES (510954, 'CASAL', true);
INSERT INTO naturezas VALUES (510955, 'TELASA', true);
INSERT INTO naturezas VALUES (510956, 'CEAL', true);
INSERT INTO naturezas VALUES (510957, 'NOTAS FISCAIS', true);
INSERT INTO naturezas VALUES (510958, 'PRESTA��O DE CONTAS DA CAPITAL', true);
INSERT INTO naturezas VALUES (510959, 'IPTU', true);
INSERT INTO naturezas VALUES (510960, 'PRESTA��O DE CONTAS DO INTERIOR', true);
INSERT INTO naturezas VALUES (510961, 'DI�RIAS DE CONV�NIO', true);
INSERT INTO naturezas VALUES (510962, 'SOLICITA��O DE VERBAS DE CONV�NIO', true);
INSERT INTO naturezas VALUES (510963, 'PROCESSO LICITAT�RIO', true);
INSERT INTO naturezas VALUES (510964, 'APROVA��O DE PROJETOS', true);
INSERT INTO naturezas VALUES (510965, 'CADASTRAMENTO DE FIRMA', true);
INSERT INTO naturezas VALUES (510966, 'MAPA ESTAT�STICO AMBULATORIAL', true);
INSERT INTO naturezas VALUES (510967, 'ADICIONAL NOTURNO', true);
INSERT INTO naturezas VALUES (510968, 'FREQU�NCIAS DA CAPITAL', true);
INSERT INTO naturezas VALUES (510969, 'FREQU�NCIAS DO INTERIOR', true);
INSERT INTO naturezas VALUES (510970, 'MUDAN�A DE GEST�O', true);
INSERT INTO naturezas VALUES (510971, 'ORDEM DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (510972, 'EXTRATOS BANC�RIOS', true);
INSERT INTO naturezas VALUES (510973, 'CONV�NIOS', true);
INSERT INTO naturezas VALUES (510974, 'AQUISI��O DE MATERIAIS DIVERSOS', true);
INSERT INTO naturezas VALUES (510975, 'SOLICITA��O DE MEDICAMENTOS', true);
INSERT INTO naturezas VALUES (510976, 'MAPA DE MOVIMENTA��O DE MEDICAMENTOS', true);
INSERT INTO naturezas VALUES (510977, 'VIAGEM TERRESTRE', true);
INSERT INTO naturezas VALUES (510978, 'FATURA', true);
INSERT INTO naturezas VALUES (510979, 'AVERBA��O DE LICEN�A ESPECIAL', true);
INSERT INTO naturezas VALUES (510980, 'CONCESS�O DE SAL�RIO FAM�LIA', true);
INSERT INTO naturezas VALUES (510981, 'AUDITORIA', true);
INSERT INTO naturezas VALUES (510982, 'GATILHO E TRIMESTRALIDADE', true);
INSERT INTO naturezas VALUES (510983, 'ESCALA DE PLANT�ES', true);
INSERT INTO naturezas VALUES (510984, 'MEDICAMENTOS', true);
INSERT INTO naturezas VALUES (510985, 'DIVERSOS', true);
INSERT INTO naturezas VALUES (510986, 'SOLICITA��O', true);
INSERT INTO naturezas VALUES (510987, 'ENCAMINHAMENTO', true);
INSERT INTO naturezas VALUES (510988, 'RELAT�RIO', true);
INSERT INTO naturezas VALUES (510989, 'RECURSOS FINANCEIROS ORIUNDOS DE CONV�NIO', true);
INSERT INTO naturezas VALUES (510990, 'DEVOLU��O', true);
INSERT INTO naturezas VALUES (510992, 'ADIANTAMENTO', true);
INSERT INTO naturezas VALUES (510993, 'COMPRA EMERGENCIAL', true);
INSERT INTO naturezas VALUES (510994, 'NOMEA��O', true);
INSERT INTO naturezas VALUES (510995, 'CONCESS�O DE LICEN�A', true);
INSERT INTO naturezas VALUES (510996, 'INFORMATIVO', true);
INSERT INTO naturezas VALUES (510997, 'COMUNICADO', true);
INSERT INTO naturezas VALUES (510998, 'INFORMA��O', true);
INSERT INTO naturezas VALUES (510999, 'CONVITE', true);
INSERT INTO naturezas VALUES (511000, 'REQUERIMENTO', true);
INSERT INTO naturezas VALUES (511001, 'REIMPLANTA��O', true);
INSERT INTO naturezas VALUES (511002, 'SOLICITA��O DE PASSAGENS A�REAS', true);
INSERT INTO naturezas VALUES (511003, 'SOLICITA��O DE PASSAGENS A�REAS E DI�RIAS', true);
INSERT INTO naturezas VALUES (511004, 'LEIL�O', true);
INSERT INTO naturezas VALUES (511005, 'REFORMA POR INCAPACIDADE DEFINITIVA', true);
INSERT INTO naturezas VALUES (511006, 'ENVIO DE DECIS�ES JUDICIAIS', true);
INSERT INTO naturezas VALUES (511007, 'SOLICITA��O DE ADES�O', true);
INSERT INTO naturezas VALUES (511008, 'CONTRIBUI��O PATRONAL', true);
INSERT INTO naturezas VALUES (511009, 'PEDIDO DE RECONSIDERA��O', true);
INSERT INTO naturezas VALUES (511010, 'SINDIC�NCIA ADMINISTRATIVA', true);
INSERT INTO naturezas VALUES (511011, 'CONTABILIZA��O DA FOLHA DE PAGAMENTO', true);
INSERT INTO naturezas VALUES (511012, 'CONTABILIZA��O DAS OBRIGA��ES PATRONAIS', true);
INSERT INTO naturezas VALUES (511013, 'SOLICITA��O DE CONSERTO DE VE�CULOS', true);
INSERT INTO naturezas VALUES (510835, 'CREDENCIAMENTO DE CL�NICA                        ', true);
INSERT INTO naturezas VALUES (511014, 'CONVOCA��O', true);
INSERT INTO naturezas VALUES (511015, 'MANUTEN��O DE VE�CULOS', true);
INSERT INTO naturezas VALUES (511016, 'AQUISI��O DE BANDEIRAS', true);
INSERT INTO naturezas VALUES (511017, 'SOLICITA��O DE COMBUST�VEL AERON�UTICO', true);
INSERT INTO naturezas VALUES (511018, 'AUTORIZA��O PARA AFASTAMENTO DO PA�S', true);
INSERT INTO naturezas VALUES (511019, 'ASSUNTOS FINANCEIROS', true);
INSERT INTO naturezas VALUES (511020, 'INFRA��ES', true);
INSERT INTO naturezas VALUES (511021, 'REQUISI��O DE AERONAVE(S)', true);
INSERT INTO naturezas VALUES (511023, 'VEICULAR', true);
INSERT INTO naturezas VALUES (511024, '2005646', true);
INSERT INTO naturezas VALUES (511025, 'REUNI�O', true);
INSERT INTO naturezas VALUES (511026, 'HABILITA��O', true);
INSERT INTO naturezas VALUES (511027, 'VE�CULOS', true);
INSERT INTO naturezas VALUES (511028, 'JUDICIAL', true);
INSERT INTO naturezas VALUES (511029, 'INFRA��ES DE TR�NSITO', true);
INSERT INTO naturezas VALUES (511030, 'FINANCEIRA', true);
INSERT INTO naturezas VALUES (511031, 'ADMINISTRATIVA', true);
INSERT INTO naturezas VALUES (511032, 'GEST�O DE PESSOAL', true);
INSERT INTO naturezas VALUES (511033, 'INSTITUCIONAL', true);
INSERT INTO naturezas VALUES (511034, 'ANALISE DE PROPOSTA - SQD/PNCF', true);
INSERT INTO naturezas VALUES (511035, 'REDEMARCA��O DE LOTE', true);
INSERT INTO naturezas VALUES (511036, 'MUDAN�A DE PRODUTOR RURAL', true);
INSERT INTO naturezas VALUES (511037, 'SUBSTITUI��O DE PRODUTOR RURAL', true);
INSERT INTO naturezas VALUES (511038, 'OUVIDORIA', true);
INSERT INTO naturezas VALUES (511039, 'A��O �RDIN�RIA', true);
INSERT INTO naturezas VALUES (511040, 'VISTORIA T�CNICA', true);
INSERT INTO naturezas VALUES (511041, 'RATIFICA��O', true);
INSERT INTO naturezas VALUES (511042, 'PAGAMENTO DE VERBAS INDENIZAT�RIA', true);
INSERT INTO naturezas VALUES (511043, 'SUBSTITUTO��O DE MEMBROS DA ASSOCIA��O', true);
INSERT INTO naturezas VALUES (511044, 'SUBSTITUI��O DE MEMBRO DA ASSOCIA��O', true);
INSERT INTO naturezas VALUES (511045, 'RECOLHIMENTO FGTS', true);
INSERT INTO naturezas VALUES (511046, 'NOTIFICA��O DE INFRA��O DE TR�NSITO', true);
INSERT INTO naturezas VALUES (511047, 'EMISS�O DE DAP''S', true);
INSERT INTO naturezas VALUES (511048, 'PRONAF A', true);
INSERT INTO naturezas VALUES (511049, 'DIFEREN�A DE SUBS�DIO', true);
INSERT INTO naturezas VALUES (511050, 'MANUTEN��O DE AERONAVES', true);
INSERT INTO naturezas VALUES (511051, 'CURSO(S)', true);
INSERT INTO naturezas VALUES (511052, 'PROVID�NCIA(S)', true);
INSERT INTO naturezas VALUES (511053, 'CONCESS�O DE MEDALHA', true);
INSERT INTO naturezas VALUES (511054, 'PRORROGA��O', true);
INSERT INTO naturezas VALUES (511055, 'PAGAMENTO DE CONTAS DE ENERGIA EL�TRICA', true);
INSERT INTO naturezas VALUES (511056, 'TRANSFER�NCIA DE REGISTRO DE ARMA DE FOGO', true);
INSERT INTO naturezas VALUES (511057, 'RENOVA��O DE REGISTRO DE ARMA DE FOGO', true);
INSERT INTO naturezas VALUES (511058, 'REGISTRO DE ARMA DE FOGO', true);


--
-- TOC entry 2107 (class 0 OID 30206)
-- Dependencies: 169
-- Data for Name: orgaos; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO orgaos VALUES (2, '0001', '�RG�O PADR�O', 'PDR', true, false, '0001');


--
-- TOC entry 2108 (class 0 OID 30214)
-- Dependencies: 171
-- Data for Name: paralisacoes; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2109 (class 0 OID 30224)
-- Dependencies: 173
-- Data for Name: permissoes_grupo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO permissoes_grupo VALUES (67, 21, 1);
INSERT INTO permissoes_grupo VALUES (68, 7, 5);
INSERT INTO permissoes_grupo VALUES (69, 8, 5);
INSERT INTO permissoes_grupo VALUES (1, 1, 1);
INSERT INTO permissoes_grupo VALUES (2, 2, 1);
INSERT INTO permissoes_grupo VALUES (3, 3, 1);
INSERT INTO permissoes_grupo VALUES (4, 4, 1);
INSERT INTO permissoes_grupo VALUES (5, 5, 1);
INSERT INTO permissoes_grupo VALUES (6, 6, 1);
INSERT INTO permissoes_grupo VALUES (7, 7, 1);
INSERT INTO permissoes_grupo VALUES (8, 8, 1);
INSERT INTO permissoes_grupo VALUES (9, 9, 1);
INSERT INTO permissoes_grupo VALUES (10, 10, 1);
INSERT INTO permissoes_grupo VALUES (11, 11, 1);
INSERT INTO permissoes_grupo VALUES (12, 12, 1);
INSERT INTO permissoes_grupo VALUES (13, 13, 1);
INSERT INTO permissoes_grupo VALUES (14, 14, 1);
INSERT INTO permissoes_grupo VALUES (15, 15, 1);
INSERT INTO permissoes_grupo VALUES (16, 16, 1);
INSERT INTO permissoes_grupo VALUES (17, 17, 1);
INSERT INTO permissoes_grupo VALUES (18, 18, 1);
INSERT INTO permissoes_grupo VALUES (19, 19, 1);
INSERT INTO permissoes_grupo VALUES (20, 20, 1);
INSERT INTO permissoes_grupo VALUES (21, 1, 2);
INSERT INTO permissoes_grupo VALUES (22, 2, 2);
INSERT INTO permissoes_grupo VALUES (23, 3, 2);
INSERT INTO permissoes_grupo VALUES (24, 4, 2);
INSERT INTO permissoes_grupo VALUES (25, 5, 2);
INSERT INTO permissoes_grupo VALUES (26, 6, 2);
INSERT INTO permissoes_grupo VALUES (27, 7, 2);
INSERT INTO permissoes_grupo VALUES (28, 8, 2);
INSERT INTO permissoes_grupo VALUES (29, 9, 2);
INSERT INTO permissoes_grupo VALUES (30, 10, 2);
INSERT INTO permissoes_grupo VALUES (31, 11, 2);
INSERT INTO permissoes_grupo VALUES (32, 12, 2);
INSERT INTO permissoes_grupo VALUES (33, 13, 2);
INSERT INTO permissoes_grupo VALUES (34, 14, 2);
INSERT INTO permissoes_grupo VALUES (35, 1, 4);
INSERT INTO permissoes_grupo VALUES (36, 2, 4);
INSERT INTO permissoes_grupo VALUES (37, 3, 4);
INSERT INTO permissoes_grupo VALUES (38, 4, 4);
INSERT INTO permissoes_grupo VALUES (39, 5, 4);
INSERT INTO permissoes_grupo VALUES (40, 6, 4);
INSERT INTO permissoes_grupo VALUES (41, 7, 4);
INSERT INTO permissoes_grupo VALUES (42, 8, 4);
INSERT INTO permissoes_grupo VALUES (43, 9, 4);
INSERT INTO permissoes_grupo VALUES (44, 10, 4);
INSERT INTO permissoes_grupo VALUES (45, 11, 4);
INSERT INTO permissoes_grupo VALUES (46, 12, 4);
INSERT INTO permissoes_grupo VALUES (47, 13, 4);
INSERT INTO permissoes_grupo VALUES (48, 14, 4);
INSERT INTO permissoes_grupo VALUES (49, 15, 4);
INSERT INTO permissoes_grupo VALUES (50, 16, 4);
INSERT INTO permissoes_grupo VALUES (51, 17, 4);
INSERT INTO permissoes_grupo VALUES (52, 19, 4);
INSERT INTO permissoes_grupo VALUES (53, 20, 4);
INSERT INTO permissoes_grupo VALUES (54, 1, 5);
INSERT INTO permissoes_grupo VALUES (55, 2, 5);
INSERT INTO permissoes_grupo VALUES (56, 3, 5);
INSERT INTO permissoes_grupo VALUES (57, 5, 5);
INSERT INTO permissoes_grupo VALUES (58, 6, 5);
INSERT INTO permissoes_grupo VALUES (59, 9, 5);
INSERT INTO permissoes_grupo VALUES (60, 10, 5);
INSERT INTO permissoes_grupo VALUES (61, 11, 5);
INSERT INTO permissoes_grupo VALUES (62, 12, 5);
INSERT INTO permissoes_grupo VALUES (63, 13, 5);
INSERT INTO permissoes_grupo VALUES (64, 14, 5);
INSERT INTO permissoes_grupo VALUES (65, 11, 7);
INSERT INTO permissoes_grupo VALUES (66, 12, 7);
INSERT INTO permissoes_grupo VALUES (70, 21, 1);


--
-- TOC entry 2110 (class 0 OID 30230)
-- Dependencies: 175
-- Data for Name: permissoes_servidor; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2111 (class 0 OID 30236)
-- Dependencies: 177
-- Data for Name: processos; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2112 (class 0 OID 30249)
-- Dependencies: 179
-- Data for Name: processos_anexos; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2113 (class 0 OID 30256)
-- Dependencies: 181
-- Data for Name: servidores; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO servidores VALUES (5802, 1, 1, 1, 'ADMINISTRADOR', '00000000000', '000000', 'ADMINISTRADOR', 'E10ADC3949BA59ABBE56E057F20F883E', true, '2013-04-02', '2013-04-02', NULL);


--
-- TOC entry 2114 (class 0 OID 30264)
-- Dependencies: 183
-- Data for Name: setores; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO setores VALUES (1, 2, 'PADR�O', 'SETOR PADR�O', true, false);


--
-- TOC entry 2115 (class 0 OID 30272)
-- Dependencies: 185
-- Data for Name: setores_servidores; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2116 (class 0 OID 30278)
-- Dependencies: 187
-- Data for Name: situacoes; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO situacoes VALUES (1, 'NORMAL', 'n');
INSERT INTO situacoes VALUES (2, 'ARQUIVADO', 'a');
INSERT INTO situacoes VALUES (3, 'PARALISADO', 'p');
INSERT INTO situacoes VALUES (4, 'LIQUIDADO', 'l');


--
-- TOC entry 2117 (class 0 OID 30284)
-- Dependencies: 189
-- Data for Name: tipos_interessado; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO tipos_interessado VALUES (1, 'Pessoa F�sica');
INSERT INTO tipos_interessado VALUES (3, 'Pessoa Jur�dica');
INSERT INTO tipos_interessado VALUES (4, '�rg�o');
INSERT INTO tipos_interessado VALUES (5, 'Usu�rio do Sistema');
INSERT INTO tipos_interessado VALUES (6, 'Servidor P�blico');
INSERT INTO tipos_interessado VALUES (7, 'Setor');
INSERT INTO tipos_interessado VALUES (9, 'MANIFESTO FEMENINO DE APOIO AO ADVOGADO TUTM�S AIR');
INSERT INTO tipos_interessado VALUES (11, 'DIRETOR');
INSERT INTO tipos_interessado VALUES (14, 'AFIS CRIMINAL');
INSERT INTO tipos_interessado VALUES (19, '558303');
INSERT INTO tipos_interessado VALUES (20, 'JOS� CLAWTON NAZ�RIO DA SILVA');
INSERT INTO tipos_interessado VALUES (24, 'REITORIA/UNEAL');
INSERT INTO tipos_interessado VALUES (26, 'PROGRAD/UNEAL');
INSERT INTO tipos_interessado VALUES (27, 'PROPEP/UNEAL');
INSERT INTO tipos_interessado VALUES (29, 'PROEXT/UNEAL');
INSERT INTO tipos_interessado VALUES (30, 'DIRE��O CAMPUS I/UNEAL');
INSERT INTO tipos_interessado VALUES (31, 'DIRE��O CAMPUS II/UNEAL');
INSERT INTO tipos_interessado VALUES (32, 'DIRE��O CAMPUS III/UNEAL');
INSERT INTO tipos_interessado VALUES (33, 'DIRE��O CAMPUS IV/UNEAL');
INSERT INTO tipos_interessado VALUES (34, 'DIRE��O CAMPUS V/UNEAL');
INSERT INTO tipos_interessado VALUES (35, 'PRODHU/UNEAL');
INSERT INTO tipos_interessado VALUES (36, 'ELANDRES');
INSERT INTO tipos_interessado VALUES (37, 'PROPEG/UNEAL');
INSERT INTO tipos_interessado VALUES (38, 'DIRE��O CAMPUS III/UNEAL');
INSERT INTO tipos_interessado VALUES (39, 'DIRE��O CAMPUS III/UNEAL');
INSERT INTO tipos_interessado VALUES (40, 'DIRE��O DO CAMPUS III/UNEAL');
INSERT INTO tipos_interessado VALUES (41, 'DIRE��O DO CAMPUS III/UNEAL');
INSERT INTO tipos_interessado VALUES (42, 'MAGNA CHARLES FERREIRA');
INSERT INTO tipos_interessado VALUES (43, 'M�RIO ANDR� MRINHO DE BRITO');
INSERT INTO tipos_interessado VALUES (45, 'COMISSAO DE PROGRESSAO FUNCIONAL-CPF/ITERAL');
INSERT INTO tipos_interessado VALUES (46, 'UNEAL/COORD. GERAL DO SITAGRO');
INSERT INTO tipos_interessado VALUES (47, 'UNEAL/COORD. GERAL DO SITAGRO');
INSERT INTO tipos_interessado VALUES (48, '2005646');
INSERT INTO tipos_interessado VALUES (49, 'GRUPAMENTO');
INSERT INTO tipos_interessado VALUES (51, 'NDJ-NOVA DIMENS�O JUR�DICA');
INSERT INTO tipos_interessado VALUES (52, 'VAP');
INSERT INTO tipos_interessado VALUES (53, 'VAP');
INSERT INTO tipos_interessado VALUES (54, 'JOS� MONTEIRO DA SILVA FILHO');


--
-- TOC entry 2118 (class 0 OID 30290)
-- Dependencies: 191
-- Data for Name: tipos_mensagem; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO tipos_mensagem VALUES (1, 'D�vidas');
INSERT INTO tipos_mensagem VALUES (2, 'Reclama��es');
INSERT INTO tipos_mensagem VALUES (3, 'Sugest�es');
INSERT INTO tipos_mensagem VALUES (4, 'Solicita&ccedil;&atilde;o');


--
-- TOC entry 2119 (class 0 OID 30296)
-- Dependencies: 193
-- Data for Name: tipos_processo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO tipos_processo VALUES (1, 'Normal');
INSERT INTO tipos_processo VALUES (2, 'Ata');
INSERT INTO tipos_processo VALUES (4, 'Dispensa de Licita��o');
INSERT INTO tipos_processo VALUES (5, 'Licita��o');


--
-- TOC entry 2120 (class 0 OID 30302)
-- Dependencies: 195
-- Data for Name: tramites; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 1995 (class 2606 OID 30367)
-- Dependencies: 141 141
-- Name: pkarquivamentos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY arquivamentos
    ADD CONSTRAINT pkarquivamentos PRIMARY KEY (id);


--
-- TOC entry 1997 (class 2606 OID 30369)
-- Dependencies: 143 143
-- Name: pkassuntos_mensagem; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY assuntos_mensagem
    ADD CONSTRAINT pkassuntos_mensagem PRIMARY KEY (id);


--
-- TOC entry 1999 (class 2606 OID 30371)
-- Dependencies: 145 145
-- Name: pkcargos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT pkcargos PRIMARY KEY (id);


--
-- TOC entry 2001 (class 2606 OID 30373)
-- Dependencies: 147 147
-- Name: pkdias_na_mesa; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY dias_na_mesa
    ADD CONSTRAINT pkdias_na_mesa PRIMARY KEY (id);


--
-- TOC entry 2003 (class 2606 OID 30375)
-- Dependencies: 149 149
-- Name: pkdivisoes; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY divisoes
    ADD CONSTRAINT pkdivisoes PRIMARY KEY (id);


--
-- TOC entry 2005 (class 2606 OID 30377)
-- Dependencies: 151 151
-- Name: pkemails_suporte; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY emails_suporte
    ADD CONSTRAINT pkemails_suporte PRIMARY KEY (id);


--
-- TOC entry 2007 (class 2606 OID 30379)
-- Dependencies: 153 153
-- Name: pketiquetas; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY etiquetas
    ADD CONSTRAINT pketiquetas PRIMARY KEY (id);


--
-- TOC entry 2009 (class 2606 OID 30381)
-- Dependencies: 155 155
-- Name: pkgrupos_usuario; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY grupos_usuario
    ADD CONSTRAINT pkgrupos_usuario PRIMARY KEY (id);


--
-- TOC entry 2011 (class 2606 OID 30383)
-- Dependencies: 157 157
-- Name: pkhistorico_devolucoes; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY historico_devolucoes
    ADD CONSTRAINT pkhistorico_devolucoes PRIMARY KEY (id);


--
-- TOC entry 2013 (class 2606 OID 30385)
-- Dependencies: 159 159
-- Name: pkhistorico_divisoes; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY historico_divisoes
    ADD CONSTRAINT pkhistorico_divisoes PRIMARY KEY (id);


--
-- TOC entry 2015 (class 2606 OID 30387)
-- Dependencies: 161 161
-- Name: pkinteressados; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY interessados
    ADD CONSTRAINT pkinteressados PRIMARY KEY (id);


--
-- TOC entry 2054 (class 2606 OID 30655)
-- Dependencies: 198 198
-- Name: pklogs; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY logs
    ADD CONSTRAINT pklogs PRIMARY KEY (id);


--
-- TOC entry 2017 (class 2606 OID 30389)
-- Dependencies: 163 163
-- Name: pkmensagens_suporte; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY mensagens_suporte
    ADD CONSTRAINT pkmensagens_suporte PRIMARY KEY (id);


--
-- TOC entry 2019 (class 2606 OID 30391)
-- Dependencies: 165 165
-- Name: pkmodulos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY modulos
    ADD CONSTRAINT pkmodulos PRIMARY KEY (id);


--
-- TOC entry 2021 (class 2606 OID 30393)
-- Dependencies: 167 167
-- Name: pknaturezas; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY naturezas
    ADD CONSTRAINT pknaturezas PRIMARY KEY (id);


--
-- TOC entry 2023 (class 2606 OID 30395)
-- Dependencies: 169 169
-- Name: pkorgaos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY orgaos
    ADD CONSTRAINT pkorgaos PRIMARY KEY (id);


--
-- TOC entry 2025 (class 2606 OID 30397)
-- Dependencies: 171 171
-- Name: pkparalisacoes; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY paralisacoes
    ADD CONSTRAINT pkparalisacoes PRIMARY KEY (id);


--
-- TOC entry 2027 (class 2606 OID 30399)
-- Dependencies: 173 173
-- Name: pkpermissoes_grupo; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY permissoes_grupo
    ADD CONSTRAINT pkpermissoes_grupo PRIMARY KEY (id);


--
-- TOC entry 2029 (class 2606 OID 30401)
-- Dependencies: 175 175
-- Name: pkpermissoes_servidor; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY permissoes_servidor
    ADD CONSTRAINT pkpermissoes_servidor PRIMARY KEY (id);


--
-- TOC entry 2033 (class 2606 OID 30403)
-- Dependencies: 177 177
-- Name: pkprocessos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT pkprocessos PRIMARY KEY (id);


--
-- TOC entry 2035 (class 2606 OID 30405)
-- Dependencies: 179 179
-- Name: pkprocessos_anexos; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY processos_anexos
    ADD CONSTRAINT pkprocessos_anexos PRIMARY KEY (id);


--
-- TOC entry 2037 (class 2606 OID 30407)
-- Dependencies: 181 181
-- Name: pkservidores; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY servidores
    ADD CONSTRAINT pkservidores PRIMARY KEY (id);


--
-- TOC entry 2039 (class 2606 OID 30409)
-- Dependencies: 183 183
-- Name: pksetores; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY setores
    ADD CONSTRAINT pksetores PRIMARY KEY (id);


--
-- TOC entry 2041 (class 2606 OID 30411)
-- Dependencies: 185 185
-- Name: pksetores_servidores; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY setores_servidores
    ADD CONSTRAINT pksetores_servidores PRIMARY KEY (id);


--
-- TOC entry 2043 (class 2606 OID 30413)
-- Dependencies: 187 187
-- Name: pksituacoes; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY situacoes
    ADD CONSTRAINT pksituacoes PRIMARY KEY (id);


--
-- TOC entry 2049 (class 2606 OID 30415)
-- Dependencies: 193 193
-- Name: pktipo_processo; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tipos_processo
    ADD CONSTRAINT pktipo_processo PRIMARY KEY (id);


--
-- TOC entry 2045 (class 2606 OID 30417)
-- Dependencies: 189 189
-- Name: pktipos_interessado; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tipos_interessado
    ADD CONSTRAINT pktipos_interessado PRIMARY KEY (id);


--
-- TOC entry 2047 (class 2606 OID 30419)
-- Dependencies: 191 191
-- Name: pktipos_mensagem; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tipos_mensagem
    ADD CONSTRAINT pktipos_mensagem PRIMARY KEY (id);


--
-- TOC entry 2052 (class 2606 OID 30421)
-- Dependencies: 195 195
-- Name: pktramites; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT pktramites PRIMARY KEY (id);


--
-- TOC entry 2030 (class 1259 OID 30422)
-- Dependencies: 177 177 177
-- Name: idx_numero_processo_numero_orgao_numero_ano; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX idx_numero_processo_numero_orgao_numero_ano ON processos USING btree (numero_orgao, numero_processo, numero_ano);


--
-- TOC entry 2050 (class 1259 OID 30423)
-- Dependencies: 195
-- Name: idx_tramites_processo_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX idx_tramites_processo_id ON tramites USING btree (processo_id);


--
-- TOC entry 2031 (class 1259 OID 30424)
-- Dependencies: 177 177 177
-- Name: idx_unique_numero_processo_numero_orgao_numero_ano; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX idx_unique_numero_processo_numero_orgao_numero_ano ON processos USING btree (numero_orgao, numero_processo, numero_ano);


--
-- TOC entry 2055 (class 2606 OID 30425)
-- Dependencies: 2032 177 141
-- Name: fk_arquivamentos_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY arquivamentos
    ADD CONSTRAINT fk_arquivamentos_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2056 (class 2606 OID 30430)
-- Dependencies: 141 2038 183
-- Name: fk_arquivamentos_setores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY arquivamentos
    ADD CONSTRAINT fk_arquivamentos_setores FOREIGN KEY (setor_id) REFERENCES setores(id);


--
-- TOC entry 2057 (class 2606 OID 30435)
-- Dependencies: 2032 177 149
-- Name: fk_divisoes_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY divisoes
    ADD CONSTRAINT fk_divisoes_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2058 (class 2606 OID 30440)
-- Dependencies: 2036 149 181
-- Name: fk_divisoes_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY divisoes
    ADD CONSTRAINT fk_divisoes_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2059 (class 2606 OID 30445)
-- Dependencies: 157 177 2032
-- Name: fk_historico_devolucoes_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY historico_devolucoes
    ADD CONSTRAINT fk_historico_devolucoes_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2060 (class 2606 OID 30450)
-- Dependencies: 157 2036 181
-- Name: fk_historico_devolucoes_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY historico_devolucoes
    ADD CONSTRAINT fk_historico_devolucoes_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2061 (class 2606 OID 30455)
-- Dependencies: 2032 159 177
-- Name: fk_historico_divisoes_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY historico_divisoes
    ADD CONSTRAINT fk_historico_divisoes_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2062 (class 2606 OID 30460)
-- Dependencies: 159 2036 181
-- Name: fk_historico_divisoes_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY historico_divisoes
    ADD CONSTRAINT fk_historico_divisoes_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2063 (class 2606 OID 30465)
-- Dependencies: 161 189 2044
-- Name: fk_interessados_tipos_interessado; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY interessados
    ADD CONSTRAINT fk_interessados_tipos_interessado FOREIGN KEY (tipo_interessado_id) REFERENCES tipos_interessado(id);


--
-- TOC entry 2092 (class 2606 OID 30656)
-- Dependencies: 198 181 2036
-- Name: fk_logs_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY logs
    ADD CONSTRAINT fk_logs_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2064 (class 2606 OID 30470)
-- Dependencies: 163 1996 143
-- Name: fk_mensagens_suporte_assuntos_mensagem; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY mensagens_suporte
    ADD CONSTRAINT fk_mensagens_suporte_assuntos_mensagem FOREIGN KEY (assunto_mensagem_id) REFERENCES assuntos_mensagem(id);


--
-- TOC entry 2065 (class 2606 OID 30475)
-- Dependencies: 2022 163 169
-- Name: fk_mensagens_suporte_orgaos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY mensagens_suporte
    ADD CONSTRAINT fk_mensagens_suporte_orgaos FOREIGN KEY (orgao_id) REFERENCES orgaos(id);


--
-- TOC entry 2066 (class 2606 OID 30480)
-- Dependencies: 163 2046 191
-- Name: fk_mensagens_suporte_tipos_mensagem; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY mensagens_suporte
    ADD CONSTRAINT fk_mensagens_suporte_tipos_mensagem FOREIGN KEY (tipo_mensagem_id) REFERENCES tipos_mensagem(id);


--
-- TOC entry 2067 (class 2606 OID 30485)
-- Dependencies: 171 177 2032
-- Name: fk_paralisacoes_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY paralisacoes
    ADD CONSTRAINT fk_paralisacoes_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2068 (class 2606 OID 30490)
-- Dependencies: 171 2036 181
-- Name: fk_paralisacoes_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY paralisacoes
    ADD CONSTRAINT fk_paralisacoes_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2069 (class 2606 OID 30495)
-- Dependencies: 183 2038 171
-- Name: fk_paralisacoes_setores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY paralisacoes
    ADD CONSTRAINT fk_paralisacoes_setores FOREIGN KEY (setor_id) REFERENCES setores(id);


--
-- TOC entry 2070 (class 2606 OID 30500)
-- Dependencies: 2008 173 155
-- Name: fk_permissoes_grupo_grupos_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY permissoes_grupo
    ADD CONSTRAINT fk_permissoes_grupo_grupos_usuario FOREIGN KEY (grupo_usuario_id) REFERENCES grupos_usuario(id);


--
-- TOC entry 2071 (class 2606 OID 30505)
-- Dependencies: 165 173 2018
-- Name: fk_permissoes_grupo_niveis; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY permissoes_grupo
    ADD CONSTRAINT fk_permissoes_grupo_niveis FOREIGN KEY (modulo_id) REFERENCES modulos(id);


--
-- TOC entry 2072 (class 2606 OID 30510)
-- Dependencies: 175 2018 165
-- Name: fk_permissoes_servidor_niveis; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY permissoes_servidor
    ADD CONSTRAINT fk_permissoes_servidor_niveis FOREIGN KEY (modulo_id) REFERENCES modulos(id);


--
-- TOC entry 2073 (class 2606 OID 30515)
-- Dependencies: 181 175 2036
-- Name: fk_permissoes_servidor_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY permissoes_servidor
    ADD CONSTRAINT fk_permissoes_servidor_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2079 (class 2606 OID 30520)
-- Dependencies: 177 179 2032
-- Name: fk_processos_anexos_processos_anexo; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos_anexos
    ADD CONSTRAINT fk_processos_anexos_processos_anexo FOREIGN KEY (processo_anexo_id) REFERENCES processos(id);


--
-- TOC entry 2080 (class 2606 OID 30525)
-- Dependencies: 179 2032 177
-- Name: fk_processos_anexos_processos_principal; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos_anexos
    ADD CONSTRAINT fk_processos_anexos_processos_principal FOREIGN KEY (processo_principal_id) REFERENCES processos(id);


--
-- TOC entry 2074 (class 2606 OID 30530)
-- Dependencies: 177 2014 161
-- Name: fk_processos_interessados; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT fk_processos_interessados FOREIGN KEY (interessado_id) REFERENCES interessados(id);


--
-- TOC entry 2075 (class 2606 OID 30535)
-- Dependencies: 2020 167 177
-- Name: fk_processos_naturezas; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT fk_processos_naturezas FOREIGN KEY (natureza_id) REFERENCES naturezas(id);


--
-- TOC entry 2076 (class 2606 OID 30540)
-- Dependencies: 181 177 2036
-- Name: fk_processos_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT fk_processos_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2077 (class 2606 OID 30545)
-- Dependencies: 2038 177 183
-- Name: fk_processos_setores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT fk_processos_setores FOREIGN KEY (setor_id) REFERENCES setores(id);


--
-- TOC entry 2078 (class 2606 OID 30550)
-- Dependencies: 177 187 2042
-- Name: fk_processos_situacoes; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY processos
    ADD CONSTRAINT fk_processos_situacoes FOREIGN KEY (situacao_id) REFERENCES situacoes(id);


--
-- TOC entry 2081 (class 2606 OID 30555)
-- Dependencies: 181 1998 145
-- Name: fk_servidores_cargos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY servidores
    ADD CONSTRAINT fk_servidores_cargos FOREIGN KEY (cargo_id) REFERENCES cargos(id);


--
-- TOC entry 2082 (class 2606 OID 30560)
-- Dependencies: 155 181 2008
-- Name: fk_servidores_grupos_usuario; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY servidores
    ADD CONSTRAINT fk_servidores_grupos_usuario FOREIGN KEY (grupo_usuario_id) REFERENCES grupos_usuario(id);


--
-- TOC entry 2083 (class 2606 OID 30565)
-- Dependencies: 2038 183 181
-- Name: fk_servidores_setores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY servidores
    ADD CONSTRAINT fk_servidores_setores FOREIGN KEY (setor_id) REFERENCES setores(id);


--
-- TOC entry 2084 (class 2606 OID 30570)
-- Dependencies: 183 2022 169
-- Name: fk_setores_orgaos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY setores
    ADD CONSTRAINT fk_setores_orgaos FOREIGN KEY (orgao_id) REFERENCES orgaos(id);


--
-- TOC entry 2085 (class 2606 OID 30575)
-- Dependencies: 185 2036 181
-- Name: fk_setores_servidores_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY setores_servidores
    ADD CONSTRAINT fk_setores_servidores_servidores FOREIGN KEY (servidor_id) REFERENCES servidores(id);


--
-- TOC entry 2086 (class 2606 OID 30580)
-- Dependencies: 2038 185 183
-- Name: fk_setores_servidores_setores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY setores_servidores
    ADD CONSTRAINT fk_setores_servidores_setores FOREIGN KEY (setor_id) REFERENCES setores(id);


--
-- TOC entry 2087 (class 2606 OID 30585)
-- Dependencies: 195 2032 177
-- Name: fk_tramites_processos; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT fk_tramites_processos FOREIGN KEY (processo_id) REFERENCES processos(id);


--
-- TOC entry 2088 (class 2606 OID 30590)
-- Dependencies: 195 2036 181
-- Name: fk_tramites_servidores; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT fk_tramites_servidores FOREIGN KEY (servidor_origem_id) REFERENCES servidores(id);


--
-- TOC entry 2089 (class 2606 OID 30595)
-- Dependencies: 2036 195 181
-- Name: fk_tramites_servidores_recebimento; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT fk_tramites_servidores_recebimento FOREIGN KEY (servidor_recebimento_id) REFERENCES servidores(id);


--
-- TOC entry 2090 (class 2606 OID 30600)
-- Dependencies: 183 195 2038
-- Name: fk_tramites_setores_origem; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT fk_tramites_setores_origem FOREIGN KEY (setor_origem_id) REFERENCES setores(id);


--
-- TOC entry 2091 (class 2606 OID 30605)
-- Dependencies: 195 2038 183
-- Name: fk_tramites_setores_recebimento; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY tramites
    ADD CONSTRAINT fk_tramites_setores_recebimento FOREIGN KEY (setor_recebimento_id) REFERENCES setores(id);


--
-- TOC entry 2125 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-04-02 13:05:15 BRT

--
-- PostgreSQL database dump complete
--

