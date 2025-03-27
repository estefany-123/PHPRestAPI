--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4 (Ubuntu 17.4-1.pgdg20.04+2)
-- Dumped by pg_dump version 17.4 (Ubuntu 17.4-1.pgdg20.04+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: actualizar_fecha_modificacion(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.actualizar_fecha_modificacion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
  NEW.updated_at = NOW();
  RETURN NEW;
END;
$$;


ALTER FUNCTION public.actualizar_fecha_modificacion() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: areas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.areas (
    id_area integer NOT NULL,
    nombre character varying(70),
    persona_encargada character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_sede integer NOT NULL
);


ALTER TABLE public.areas OWNER TO postgres;

--
-- Name: areas_id_area_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.areas_id_area_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.areas_id_area_seq OWNER TO postgres;

--
-- Name: areas_id_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.areas_id_area_seq OWNED BY public.areas.id_area;


--
-- Name: caracteristicas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.caracteristicas (
    id_caracteristica integer NOT NULL,
    nombre character varying(70),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.caracteristicas OWNER TO postgres;

--
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.caracteristicas_id_caracteristica_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.caracteristicas_id_caracteristica_seq OWNER TO postgres;

--
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.caracteristicas_id_caracteristica_seq OWNED BY public.caracteristicas.id_caracteristica;


--
-- Name: categorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorias (
    id_categoria integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.categorias OWNER TO postgres;

--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categorias_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categorias_id_categoria_seq OWNER TO postgres;

--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categorias_id_categoria_seq OWNED BY public.categorias.id_categoria;


--
-- Name: centros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.centros (
    id_centro integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_municipio integer NOT NULL
);


ALTER TABLE public.centros OWNER TO postgres;

--
-- Name: centros_id_centro_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.centros_id_centro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.centros_id_centro_seq OWNER TO postgres;

--
-- Name: centros_id_centro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.centros_id_centro_seq OWNED BY public.centros.id_centro;


--
-- Name: elementos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.elementos (
    id_elemento integer NOT NULL,
    nombre character varying(70),
    descripcion character varying(205),
    valor integer,
    consumible boolean,
    no_consumible boolean,
    estado boolean,
    imagen_elemento character varying(255),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_unidad_medida integer NOT NULL,
    fk_categoria integer NOT NULL,
    fk_caracteristica integer NOT NULL
);


ALTER TABLE public.elementos OWNER TO postgres;

--
-- Name: elementos_id_elemento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.elementos_id_elemento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.elementos_id_elemento_seq OWNER TO postgres;

--
-- Name: elementos_id_elemento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.elementos_id_elemento_seq OWNED BY public.elementos.id_elemento;


--
-- Name: fichas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fichas (
    id_ficha integer NOT NULL,
    codigo_ficha integer,
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_programa integer NOT NULL
);


ALTER TABLE public.fichas OWNER TO postgres;

--
-- Name: fichas_id_ficha_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fichas_id_ficha_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fichas_id_ficha_seq OWNER TO postgres;

--
-- Name: fichas_id_ficha_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fichas_id_ficha_seq OWNED BY public.fichas.id_ficha;


--
-- Name: inventarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inventarios (
    id_inventario integer NOT NULL,
    stock integer,
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_sitio integer NOT NULL,
    fk_elemento integer NOT NULL
);


ALTER TABLE public.inventarios OWNER TO postgres;

--
-- Name: inventarios_id_inventario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.inventarios_id_inventario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.inventarios_id_inventario_seq OWNER TO postgres;

--
-- Name: inventarios_id_inventario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.inventarios_id_inventario_seq OWNED BY public.inventarios.id_inventario;


--
-- Name: modulos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.modulos (
    id_modulo integer NOT NULL,
    nombre character varying(70),
    descripcion character varying(205),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    estado boolean
);


ALTER TABLE public.modulos OWNER TO postgres;

--
-- Name: modulos_id_modulo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.modulos_id_modulo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.modulos_id_modulo_seq OWNER TO postgres;

--
-- Name: modulos_id_modulo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.modulos_id_modulo_seq OWNED BY public.modulos.id_modulo;


--
-- Name: movimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.movimientos (
    id_movimiento integer NOT NULL,
    descripcion character varying(205),
    cantidad integer,
    hora_ingreso time without time zone,
    hora_salida time without time zone,
    aceptado boolean,
    en_proceso boolean,
    cancelado boolean,
    devolutivo boolean,
    no_devolutivo boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_sitio integer NOT NULL,
    fk_usuario integer NOT NULL,
    fk_tipo_movimiento integer NOT NULL,
    fk_inventario integer NOT NULL
);


ALTER TABLE public.movimientos OWNER TO postgres;

--
-- Name: movimientos_id_movimiento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.movimientos_id_movimiento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.movimientos_id_movimiento_seq OWNER TO postgres;

--
-- Name: movimientos_id_movimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.movimientos_id_movimiento_seq OWNED BY public.movimientos.id_movimiento;


--
-- Name: municipios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.municipios (
    id_municipio integer NOT NULL,
    nombre character varying(70),
    departamento character varying(100),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.municipios OWNER TO postgres;

--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.municipios_id_municipio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.municipios_id_municipio_seq OWNER TO postgres;

--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.municipios_id_municipio_seq OWNED BY public.municipios.id_municipio;


--
-- Name: programas_formacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.programas_formacion (
    id_programa integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_area integer NOT NULL
);


ALTER TABLE public.programas_formacion OWNER TO postgres;

--
-- Name: programas_formacion_id_programa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.programas_formacion_id_programa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.programas_formacion_id_programa_seq OWNER TO postgres;

--
-- Name: programas_formacion_id_programa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.programas_formacion_id_programa_seq OWNED BY public.programas_formacion.id_programa;


--
-- Name: rol_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol_items (
    id integer NOT NULL,
    item_id integer NOT NULL,
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_rol integer NOT NULL
);


ALTER TABLE public.rol_items OWNER TO postgres;

--
-- Name: rol_items_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rol_items_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rol_items_id_seq OWNER TO postgres;

--
-- Name: rol_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rol_items_id_seq OWNED BY public.rol_items.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id_rol integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_rol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_rol_seq OWNER TO postgres;

--
-- Name: roles_id_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_rol_seq OWNED BY public.roles.id_rol;


--
-- Name: rutas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rutas (
    id_ruta integer NOT NULL,
    nombre character varying(205),
    descripcion character varying(205),
    url_destino character varying(205),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_modulo integer NOT NULL
);


ALTER TABLE public.rutas OWNER TO postgres;

--
-- Name: rutas_id_ruta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rutas_id_ruta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rutas_id_ruta_seq OWNER TO postgres;

--
-- Name: rutas_id_ruta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rutas_id_ruta_seq OWNED BY public.rutas.id_ruta;


--
-- Name: rutas_rol_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rutas_rol_items (
    id_ruta_rol integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_ruta integer NOT NULL,
    fk_rol_item integer NOT NULL
);


ALTER TABLE public.rutas_rol_items OWNER TO postgres;

--
-- Name: rutas_rol_items_id_ruta_rol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rutas_rol_items_id_ruta_rol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rutas_rol_items_id_ruta_rol_seq OWNER TO postgres;

--
-- Name: rutas_rol_items_id_ruta_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rutas_rol_items_id_ruta_rol_seq OWNED BY public.rutas_rol_items.id_ruta_rol;


--
-- Name: sedes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sedes (
    id_sede integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_centro integer NOT NULL
);


ALTER TABLE public.sedes OWNER TO postgres;

--
-- Name: sedes_id_sede_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sedes_id_sede_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sedes_id_sede_seq OWNER TO postgres;

--
-- Name: sedes_id_sede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sedes_id_sede_seq OWNED BY public.sedes.id_sede;


--
-- Name: sitios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sitios (
    id_sitio integer NOT NULL,
    nombre character varying(70),
    persona_encargada character varying(70),
    ubicacion character varying(205),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_tipo_sitio integer NOT NULL,
    fk_area integer NOT NULL
);


ALTER TABLE public.sitios OWNER TO postgres;

--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sitios_id_sitio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sitios_id_sitio_seq OWNER TO postgres;

--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sitios_id_sitio_seq OWNED BY public.sitios.id_sitio;


--
-- Name: solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitudes (
    id_solicitud integer NOT NULL,
    descripcion character varying(205),
    cantidad integer,
    aceptada boolean,
    pendiente boolean,
    rechazada boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_usuario integer NOT NULL,
    fk_inventario integer NOT NULL
);


ALTER TABLE public.solicitudes OWNER TO postgres;

--
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitudes_id_solicitud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitudes_id_solicitud_seq OWNER TO postgres;

--
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitudes_id_solicitud_seq OWNED BY public.solicitudes.id_solicitud;


--
-- Name: tipo_movimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_movimientos (
    id_tipo integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.tipo_movimientos OWNER TO postgres;

--
-- Name: tipo_movimientos_id_tipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_movimientos_id_tipo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_movimientos_id_tipo_seq OWNER TO postgres;

--
-- Name: tipo_movimientos_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_movimientos_id_tipo_seq OWNED BY public.tipo_movimientos.id_tipo;


--
-- Name: tipo_sitios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_sitios (
    id_tipo integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.tipo_sitios OWNER TO postgres;

--
-- Name: tipo_sitios_id_tipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_sitios_id_tipo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipo_sitios_id_tipo_seq OWNER TO postgres;

--
-- Name: tipo_sitios_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_sitios_id_tipo_seq OWNED BY public.tipo_sitios.id_tipo;


--
-- Name: unidades_medida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidades_medida (
    id_unidad integer NOT NULL,
    nombre character varying(70),
    estado boolean,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.unidades_medida OWNER TO postgres;

--
-- Name: unidades_medida_id_unidad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unidades_medida_id_unidad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.unidades_medida_id_unidad_seq OWNER TO postgres;

--
-- Name: unidades_medida_id_unidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unidades_medida_id_unidad_seq OWNED BY public.unidades_medida.id_unidad;


--
-- Name: usuario_ficha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_ficha (
    id_usuario_ficha integer NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_usuario integer NOT NULL,
    fk_ficha integer NOT NULL
);


ALTER TABLE public.usuario_ficha OWNER TO postgres;

--
-- Name: usuario_ficha_id_usuario_ficha_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_ficha_id_usuario_ficha_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuario_ficha_id_usuario_ficha_seq OWNER TO postgres;

--
-- Name: usuario_ficha_id_usuario_ficha_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_ficha_id_usuario_ficha_seq OWNED BY public.usuario_ficha.id_usuario_ficha;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    documento integer,
    nombre character varying(70),
    apellido character varying(70),
    edad integer,
    telefono character varying(15),
    correo character varying(70),
    estado boolean,
    cargo character varying(70),
    password character varying(60),
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_rol integer NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_usuario_seq OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- Name: verificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.verificaciones (
    id_verificacion integer NOT NULL,
    persona_encargada character varying(70),
    persona_asignada character varying(70),
    hora_ingreso time without time zone,
    hora_fin time without time zone,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone DEFAULT now() NOT NULL,
    fk_inventario integer NOT NULL
);


ALTER TABLE public.verificaciones OWNER TO postgres;

--
-- Name: verificaciones_id_verificacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.verificaciones_id_verificacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.verificaciones_id_verificacion_seq OWNER TO postgres;

--
-- Name: verificaciones_id_verificacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.verificaciones_id_verificacion_seq OWNED BY public.verificaciones.id_verificacion;


--
-- Name: areas id_area; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.areas ALTER COLUMN id_area SET DEFAULT nextval('public.areas_id_area_seq'::regclass);


--
-- Name: caracteristicas id_caracteristica; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caracteristicas ALTER COLUMN id_caracteristica SET DEFAULT nextval('public.caracteristicas_id_caracteristica_seq'::regclass);


--
-- Name: categorias id_categoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias ALTER COLUMN id_categoria SET DEFAULT nextval('public.categorias_id_categoria_seq'::regclass);


--
-- Name: centros id_centro; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.centros ALTER COLUMN id_centro SET DEFAULT nextval('public.centros_id_centro_seq'::regclass);


--
-- Name: elementos id_elemento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elementos ALTER COLUMN id_elemento SET DEFAULT nextval('public.elementos_id_elemento_seq'::regclass);


--
-- Name: fichas id_ficha; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas ALTER COLUMN id_ficha SET DEFAULT nextval('public.fichas_id_ficha_seq'::regclass);


--
-- Name: inventarios id_inventario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventarios ALTER COLUMN id_inventario SET DEFAULT nextval('public.inventarios_id_inventario_seq'::regclass);


--
-- Name: modulos id_modulo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulos ALTER COLUMN id_modulo SET DEFAULT nextval('public.modulos_id_modulo_seq'::regclass);


--
-- Name: movimientos id_movimiento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos ALTER COLUMN id_movimiento SET DEFAULT nextval('public.movimientos_id_movimiento_seq'::regclass);


--
-- Name: municipios id_municipio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipios ALTER COLUMN id_municipio SET DEFAULT nextval('public.municipios_id_municipio_seq'::regclass);


--
-- Name: programas_formacion id_programa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programas_formacion ALTER COLUMN id_programa SET DEFAULT nextval('public.programas_formacion_id_programa_seq'::regclass);


--
-- Name: rol_items id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_items ALTER COLUMN id SET DEFAULT nextval('public.rol_items_id_seq'::regclass);


--
-- Name: roles id_rol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id_rol SET DEFAULT nextval('public.roles_id_rol_seq'::regclass);


--
-- Name: rutas id_ruta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas ALTER COLUMN id_ruta SET DEFAULT nextval('public.rutas_id_ruta_seq'::regclass);


--
-- Name: rutas_rol_items id_ruta_rol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas_rol_items ALTER COLUMN id_ruta_rol SET DEFAULT nextval('public.rutas_rol_items_id_ruta_rol_seq'::regclass);


--
-- Name: sedes id_sede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sedes ALTER COLUMN id_sede SET DEFAULT nextval('public.sedes_id_sede_seq'::regclass);


--
-- Name: sitios id_sitio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sitios ALTER COLUMN id_sitio SET DEFAULT nextval('public.sitios_id_sitio_seq'::regclass);


--
-- Name: solicitudes id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes ALTER COLUMN id_solicitud SET DEFAULT nextval('public.solicitudes_id_solicitud_seq'::regclass);


--
-- Name: tipo_movimientos id_tipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_movimientos ALTER COLUMN id_tipo SET DEFAULT nextval('public.tipo_movimientos_id_tipo_seq'::regclass);


--
-- Name: tipo_sitios id_tipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_sitios ALTER COLUMN id_tipo SET DEFAULT nextval('public.tipo_sitios_id_tipo_seq'::regclass);


--
-- Name: unidades_medida id_unidad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidades_medida ALTER COLUMN id_unidad SET DEFAULT nextval('public.unidades_medida_id_unidad_seq'::regclass);


--
-- Name: usuario_ficha id_usuario_ficha; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_ficha ALTER COLUMN id_usuario_ficha SET DEFAULT nextval('public.usuario_ficha_id_usuario_ficha_seq'::regclass);


--
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- Name: verificaciones id_verificacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verificaciones ALTER COLUMN id_verificacion SET DEFAULT nextval('public.verificaciones_id_verificacion_seq'::regclass);


--
-- Data for Name: areas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.areas (id_area, nombre, persona_encargada, estado, created_at, updated_at, fk_sede) FROM stdin;
\.


--
-- Data for Name: caracteristicas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.caracteristicas (id_caracteristica, nombre, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categorias (id_categoria, nombre, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: centros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.centros (id_centro, nombre, estado, created_at, updated_at, fk_municipio) FROM stdin;
\.


--
-- Data for Name: elementos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.elementos (id_elemento, nombre, descripcion, valor, consumible, no_consumible, estado, imagen_elemento, created_at, updated_at, fk_unidad_medida, fk_categoria, fk_caracteristica) FROM stdin;
\.


--
-- Data for Name: fichas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fichas (id_ficha, codigo_ficha, estado, created_at, updated_at, fk_programa) FROM stdin;
\.


--
-- Data for Name: inventarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inventarios (id_inventario, stock, estado, created_at, updated_at, fk_sitio, fk_elemento) FROM stdin;
\.


--
-- Data for Name: modulos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.modulos (id_modulo, nombre, descripcion, created_at, updated_at, estado) FROM stdin;
\.


--
-- Data for Name: movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.movimientos (id_movimiento, descripcion, cantidad, hora_ingreso, hora_salida, aceptado, en_proceso, cancelado, devolutivo, no_devolutivo, created_at, updated_at, fk_sitio, fk_usuario, fk_tipo_movimiento, fk_inventario) FROM stdin;
\.


--
-- Data for Name: municipios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.municipios (id_municipio, nombre, departamento, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: programas_formacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.programas_formacion (id_programa, nombre, estado, created_at, updated_at, fk_area) FROM stdin;
\.


--
-- Data for Name: rol_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rol_items (id, item_id, estado, created_at, updated_at, fk_rol) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id_rol, nombre, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: rutas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rutas (id_ruta, nombre, descripcion, url_destino, estado, created_at, updated_at, fk_modulo) FROM stdin;
\.


--
-- Data for Name: rutas_rol_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rutas_rol_items (id_ruta_rol, created_at, updated_at, fk_ruta, fk_rol_item) FROM stdin;
\.


--
-- Data for Name: sedes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sedes (id_sede, nombre, estado, created_at, updated_at, fk_centro) FROM stdin;
\.


--
-- Data for Name: sitios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sitios (id_sitio, nombre, persona_encargada, ubicacion, estado, created_at, updated_at, fk_tipo_sitio, fk_area) FROM stdin;
\.


--
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitudes (id_solicitud, descripcion, cantidad, aceptada, pendiente, rechazada, created_at, updated_at, fk_usuario, fk_inventario) FROM stdin;
\.


--
-- Data for Name: tipo_movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_movimientos (id_tipo, nombre, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tipo_sitios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_sitios (id_tipo, nombre, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: unidades_medida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.unidades_medida (id_unidad, nombre, estado, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: usuario_ficha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario_ficha (id_usuario_ficha, created_at, updated_at, fk_usuario, fk_ficha) FROM stdin;
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id_usuario, documento, nombre, apellido, edad, telefono, correo, estado, cargo, password, created_at, updated_at, fk_rol) FROM stdin;
\.


--
-- Data for Name: verificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.verificaciones (id_verificacion, persona_encargada, persona_asignada, hora_ingreso, hora_fin, created_at, updated_at, fk_inventario) FROM stdin;
\.


--
-- Name: areas_id_area_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.areas_id_area_seq', 1, false);


--
-- Name: caracteristicas_id_caracteristica_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.caracteristicas_id_caracteristica_seq', 1, false);


--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categorias_id_categoria_seq', 1, false);


--
-- Name: centros_id_centro_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.centros_id_centro_seq', 1, false);


--
-- Name: elementos_id_elemento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.elementos_id_elemento_seq', 1, false);


--
-- Name: fichas_id_ficha_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fichas_id_ficha_seq', 1, false);


--
-- Name: inventarios_id_inventario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inventarios_id_inventario_seq', 1, false);


--
-- Name: modulos_id_modulo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.modulos_id_modulo_seq', 1, false);


--
-- Name: movimientos_id_movimiento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.movimientos_id_movimiento_seq', 1, false);


--
-- Name: municipios_id_municipio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.municipios_id_municipio_seq', 1, false);


--
-- Name: programas_formacion_id_programa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.programas_formacion_id_programa_seq', 1, false);


--
-- Name: rol_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rol_items_id_seq', 1, false);


--
-- Name: roles_id_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_rol_seq', 1, false);


--
-- Name: rutas_id_ruta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rutas_id_ruta_seq', 1, false);


--
-- Name: rutas_rol_items_id_ruta_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rutas_rol_items_id_ruta_rol_seq', 1, false);


--
-- Name: sedes_id_sede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sedes_id_sede_seq', 1, false);


--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sitios_id_sitio_seq', 1, false);


--
-- Name: solicitudes_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_id_solicitud_seq', 1, false);


--
-- Name: tipo_movimientos_id_tipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_movimientos_id_tipo_seq', 1, false);


--
-- Name: tipo_sitios_id_tipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_sitios_id_tipo_seq', 1, false);


--
-- Name: unidades_medida_id_unidad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unidades_medida_id_unidad_seq', 1, false);


--
-- Name: usuario_ficha_id_usuario_ficha_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_ficha_id_usuario_ficha_seq', 1, false);


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1, false);


--
-- Name: verificaciones_id_verificacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.verificaciones_id_verificacion_seq', 1, false);


--
-- Name: areas areas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.areas
    ADD CONSTRAINT areas_pkey PRIMARY KEY (id_area);


--
-- Name: caracteristicas caracteristicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.caracteristicas
    ADD CONSTRAINT caracteristicas_pkey PRIMARY KEY (id_caracteristica);


--
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id_categoria);


--
-- Name: centros centros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.centros
    ADD CONSTRAINT centros_pkey PRIMARY KEY (id_centro);


--
-- Name: elementos elementos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elementos
    ADD CONSTRAINT elementos_pkey PRIMARY KEY (id_elemento);


--
-- Name: fichas fichas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas
    ADD CONSTRAINT fichas_pkey PRIMARY KEY (id_ficha);


--
-- Name: inventarios inventarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventarios
    ADD CONSTRAINT inventarios_pkey PRIMARY KEY (id_inventario);


--
-- Name: modulos modulos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.modulos
    ADD CONSTRAINT modulos_pkey PRIMARY KEY (id_modulo);


--
-- Name: movimientos movimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimientos_pkey PRIMARY KEY (id_movimiento);


--
-- Name: municipios municipios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.municipios
    ADD CONSTRAINT municipios_pkey PRIMARY KEY (id_municipio);


--
-- Name: programas_formacion programas_formacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programas_formacion
    ADD CONSTRAINT programas_formacion_pkey PRIMARY KEY (id_programa);


--
-- Name: rol_items rol_items_item_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_items
    ADD CONSTRAINT rol_items_item_id_key UNIQUE (item_id);


--
-- Name: rol_items rol_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_items
    ADD CONSTRAINT rol_items_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id_rol);


--
-- Name: rutas rutas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas
    ADD CONSTRAINT rutas_pkey PRIMARY KEY (id_ruta);


--
-- Name: rutas_rol_items rutas_rol_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas_rol_items
    ADD CONSTRAINT rutas_rol_items_pkey PRIMARY KEY (id_ruta_rol);


--
-- Name: sedes sedes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sedes
    ADD CONSTRAINT sedes_pkey PRIMARY KEY (id_sede);


--
-- Name: sitios sitios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sitios
    ADD CONSTRAINT sitios_pkey PRIMARY KEY (id_sitio);


--
-- Name: solicitudes solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);


--
-- Name: tipo_movimientos tipo_movimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_movimientos
    ADD CONSTRAINT tipo_movimientos_pkey PRIMARY KEY (id_tipo);


--
-- Name: tipo_sitios tipo_sitios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_sitios
    ADD CONSTRAINT tipo_sitios_pkey PRIMARY KEY (id_tipo);


--
-- Name: unidades_medida unidades_medida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidades_medida
    ADD CONSTRAINT unidades_medida_pkey PRIMARY KEY (id_unidad);


--
-- Name: usuario_ficha usuario_ficha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_ficha
    ADD CONSTRAINT usuario_ficha_pkey PRIMARY KEY (id_usuario_ficha);


--
-- Name: usuarios usuarios_documento_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_documento_key UNIQUE (documento);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: verificaciones verificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verificaciones
    ADD CONSTRAINT verificaciones_pkey PRIMARY KEY (id_verificacion);


--
-- Name: areas trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.areas FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: caracteristicas trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.caracteristicas FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: categorias trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.categorias FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: centros trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.centros FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: elementos trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.elementos FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: fichas trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.fichas FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: inventarios trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.inventarios FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: modulos trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.modulos FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: movimientos trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.movimientos FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: municipios trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.municipios FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: programas_formacion trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.programas_formacion FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: rol_items trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.rol_items FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: roles trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.roles FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: rutas trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.rutas FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: rutas_rol_items trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.rutas_rol_items FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: sedes trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.sedes FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: sitios trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.sitios FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: solicitudes trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.solicitudes FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: tipo_movimientos trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.tipo_movimientos FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: tipo_sitios trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.tipo_sitios FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: unidades_medida trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.unidades_medida FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: usuario_ficha trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.usuario_ficha FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: usuarios trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.usuarios FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: verificaciones trigger_actualizar_fecha; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trigger_actualizar_fecha BEFORE UPDATE ON public.verificaciones FOR EACH ROW EXECUTE FUNCTION public.actualizar_fecha_modificacion();


--
-- Name: areas area_sede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.areas
    ADD CONSTRAINT area_sede FOREIGN KEY (fk_sede) REFERENCES public.sedes(id_sede);


--
-- Name: sitios area_sitio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sitios
    ADD CONSTRAINT area_sitio FOREIGN KEY (fk_area) REFERENCES public.areas(id_area);


--
-- Name: centros centro_municipio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.centros
    ADD CONSTRAINT centro_municipio FOREIGN KEY (fk_municipio) REFERENCES public.municipios(id_municipio);


--
-- Name: elementos elemento_caractteristica; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elementos
    ADD CONSTRAINT elemento_caractteristica FOREIGN KEY (fk_caracteristica) REFERENCES public.caracteristicas(id_caracteristica);


--
-- Name: elementos elemento_categoria; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elementos
    ADD CONSTRAINT elemento_categoria FOREIGN KEY (fk_categoria) REFERENCES public.categorias(id_categoria);


--
-- Name: elementos elemento_unidad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elementos
    ADD CONSTRAINT elemento_unidad FOREIGN KEY (fk_unidad_medida) REFERENCES public.unidades_medida(id_unidad);


--
-- Name: fichas ficha_programa; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fichas
    ADD CONSTRAINT ficha_programa FOREIGN KEY (fk_programa) REFERENCES public.programas_formacion(id_programa);


--
-- Name: usuario_ficha ficha_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_ficha
    ADD CONSTRAINT ficha_usuario FOREIGN KEY (fk_ficha) REFERENCES public.fichas(id_ficha);


--
-- Name: inventarios inventario_elemento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventarios
    ADD CONSTRAINT inventario_elemento FOREIGN KEY (fk_elemento) REFERENCES public.elementos(id_elemento);


--
-- Name: movimientos inventario_movimiento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT inventario_movimiento FOREIGN KEY (fk_inventario) REFERENCES public.inventarios(id_inventario);


--
-- Name: inventarios inventario_sitio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inventarios
    ADD CONSTRAINT inventario_sitio FOREIGN KEY (fk_sitio) REFERENCES public.sitios(id_sitio);


--
-- Name: movimientos movimiento_sitio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimiento_sitio FOREIGN KEY (fk_sitio) REFERENCES public.sitios(id_sitio);


--
-- Name: movimientos movimiento_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimiento_tipo FOREIGN KEY (fk_tipo_movimiento) REFERENCES public.tipo_movimientos(id_tipo);


--
-- Name: movimientos movimiento_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimiento_usuario FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: programas_formacion programa_area; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.programas_formacion
    ADD CONSTRAINT programa_area FOREIGN KEY (fk_area) REFERENCES public.areas(id_area);


--
-- Name: rutas_rol_items rol_items; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas_rol_items
    ADD CONSTRAINT rol_items FOREIGN KEY (fk_rol_item) REFERENCES public.rol_items(id);


--
-- Name: rol_items rol_items_rol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_items
    ADD CONSTRAINT rol_items_rol FOREIGN KEY (fk_rol) REFERENCES public.roles(id_rol);


--
-- Name: rutas_rol_items rol_items_rutas; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas_rol_items
    ADD CONSTRAINT rol_items_rutas FOREIGN KEY (fk_ruta) REFERENCES public.rutas(id_ruta);


--
-- Name: usuarios rol_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT rol_usuario FOREIGN KEY (fk_rol) REFERENCES public.roles(id_rol);


--
-- Name: rutas ruta_modulo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rutas
    ADD CONSTRAINT ruta_modulo FOREIGN KEY (fk_modulo) REFERENCES public.modulos(id_modulo);


--
-- Name: sedes sede_centro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sedes
    ADD CONSTRAINT sede_centro FOREIGN KEY (fk_centro) REFERENCES public.centros(id_centro);


--
-- Name: sitios sitio_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sitios
    ADD CONSTRAINT sitio_tipo FOREIGN KEY (fk_tipo_sitio) REFERENCES public.tipo_sitios(id_tipo);


--
-- Name: solicitudes solicitud_elemento_inventario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitud_elemento_inventario FOREIGN KEY (fk_inventario) REFERENCES public.inventarios(id_inventario);


--
-- Name: solicitudes solicitud_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitud_usuario FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: usuario_ficha usuario_ficha; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_ficha
    ADD CONSTRAINT usuario_ficha FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id_usuario);


--
-- Name: verificaciones verificacion_inventario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.verificaciones
    ADD CONSTRAINT verificacion_inventario FOREIGN KEY (fk_inventario) REFERENCES public.inventarios(id_inventario);


--
-- PostgreSQL database dump complete
--

