PGDMP      ;                |            classic_play    16.6    16.6 %    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16398    classic_play    DATABASE     �   CREATE DATABASE classic_play WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE classic_play;
                postgres    false            �            1259    16411    table_gamearkanoid    TABLE     {   CREATE TABLE public.table_gamearkanoid (
    id_score integer NOT NULL,
    id_user integer,
    score integer NOT NULL
);
 &   DROP TABLE public.table_gamearkanoid;
       public         heap    postgres    false            �            1259    16410    table_gamearkanoid_id_score_seq    SEQUENCE     �   CREATE SEQUENCE public.table_gamearkanoid_id_score_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.table_gamearkanoid_id_score_seq;
       public          postgres    false    218            �           0    0    table_gamearkanoid_id_score_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.table_gamearkanoid_id_score_seq OWNED BY public.table_gamearkanoid.id_score;
          public          postgres    false    217            �            1259    16435    table_gamesnake    TABLE     x   CREATE TABLE public.table_gamesnake (
    id_score integer NOT NULL,
    id_user integer,
    score integer NOT NULL
);
 #   DROP TABLE public.table_gamesnake;
       public         heap    postgres    false            �            1259    16434    table_gamesnake_id_score_seq    SEQUENCE     �   CREATE SEQUENCE public.table_gamesnake_id_score_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.table_gamesnake_id_score_seq;
       public          postgres    false    222            �           0    0    table_gamesnake_id_score_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.table_gamesnake_id_score_seq OWNED BY public.table_gamesnake.id_score;
          public          postgres    false    221            �            1259    16423    table_gametetris    TABLE     y   CREATE TABLE public.table_gametetris (
    id_score integer NOT NULL,
    id_user integer,
    score integer NOT NULL
);
 $   DROP TABLE public.table_gametetris;
       public         heap    postgres    false            �            1259    16422    table_gametetris_id_score_seq    SEQUENCE     �   CREATE SEQUENCE public.table_gametetris_id_score_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.table_gametetris_id_score_seq;
       public          postgres    false    220            �           0    0    table_gametetris_id_score_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.table_gametetris_id_score_seq OWNED BY public.table_gametetris.id_score;
          public          postgres    false    219            �            1259    16400 
   table_user    TABLE     �   CREATE TABLE public.table_user (
    id_user integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(255) NOT NULL
);
    DROP TABLE public.table_user;
       public         heap    postgres    false            �            1259    16399    table_user_id_user_seq    SEQUENCE     �   CREATE SEQUENCE public.table_user_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.table_user_id_user_seq;
       public          postgres    false    216            �           0    0    table_user_id_user_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.table_user_id_user_seq OWNED BY public.table_user.id_user;
          public          postgres    false    215            *           2604    16414    table_gamearkanoid id_score    DEFAULT     �   ALTER TABLE ONLY public.table_gamearkanoid ALTER COLUMN id_score SET DEFAULT nextval('public.table_gamearkanoid_id_score_seq'::regclass);
 J   ALTER TABLE public.table_gamearkanoid ALTER COLUMN id_score DROP DEFAULT;
       public          postgres    false    217    218    218            ,           2604    16438    table_gamesnake id_score    DEFAULT     �   ALTER TABLE ONLY public.table_gamesnake ALTER COLUMN id_score SET DEFAULT nextval('public.table_gamesnake_id_score_seq'::regclass);
 G   ALTER TABLE public.table_gamesnake ALTER COLUMN id_score DROP DEFAULT;
       public          postgres    false    222    221    222            +           2604    16426    table_gametetris id_score    DEFAULT     �   ALTER TABLE ONLY public.table_gametetris ALTER COLUMN id_score SET DEFAULT nextval('public.table_gametetris_id_score_seq'::regclass);
 H   ALTER TABLE public.table_gametetris ALTER COLUMN id_score DROP DEFAULT;
       public          postgres    false    219    220    220            )           2604    16403    table_user id_user    DEFAULT     x   ALTER TABLE ONLY public.table_user ALTER COLUMN id_user SET DEFAULT nextval('public.table_user_id_user_seq'::regclass);
 A   ALTER TABLE public.table_user ALTER COLUMN id_user DROP DEFAULT;
       public          postgres    false    216    215    216            �          0    16411    table_gamearkanoid 
   TABLE DATA           F   COPY public.table_gamearkanoid (id_score, id_user, score) FROM stdin;
    public          postgres    false    218   ),       �          0    16435    table_gamesnake 
   TABLE DATA           C   COPY public.table_gamesnake (id_score, id_user, score) FROM stdin;
    public          postgres    false    222   F,       �          0    16423    table_gametetris 
   TABLE DATA           D   COPY public.table_gametetris (id_score, id_user, score) FROM stdin;
    public          postgres    false    220   c,       �          0    16400 
   table_user 
   TABLE DATA           H   COPY public.table_user (id_user, username, email, password) FROM stdin;
    public          postgres    false    216   �,       �           0    0    table_gamearkanoid_id_score_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.table_gamearkanoid_id_score_seq', 1, false);
          public          postgres    false    217            �           0    0    table_gamesnake_id_score_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.table_gamesnake_id_score_seq', 1, false);
          public          postgres    false    221            �           0    0    table_gametetris_id_score_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.table_gametetris_id_score_seq', 1, false);
          public          postgres    false    219            �           0    0    table_user_id_user_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.table_user_id_user_seq', 12, true);
          public          postgres    false    215            4           2606    16416 *   table_gamearkanoid table_gamearkanoid_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.table_gamearkanoid
    ADD CONSTRAINT table_gamearkanoid_pkey PRIMARY KEY (id_score);
 T   ALTER TABLE ONLY public.table_gamearkanoid DROP CONSTRAINT table_gamearkanoid_pkey;
       public            postgres    false    218            8           2606    16440 $   table_gamesnake table_gamesnake_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.table_gamesnake
    ADD CONSTRAINT table_gamesnake_pkey PRIMARY KEY (id_score);
 N   ALTER TABLE ONLY public.table_gamesnake DROP CONSTRAINT table_gamesnake_pkey;
       public            postgres    false    222            6           2606    16428 &   table_gametetris table_gametetris_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.table_gametetris
    ADD CONSTRAINT table_gametetris_pkey PRIMARY KEY (id_score);
 P   ALTER TABLE ONLY public.table_gametetris DROP CONSTRAINT table_gametetris_pkey;
       public            postgres    false    220            .           2606    16409    table_user table_user_email_key 
   CONSTRAINT     [   ALTER TABLE ONLY public.table_user
    ADD CONSTRAINT table_user_email_key UNIQUE (email);
 I   ALTER TABLE ONLY public.table_user DROP CONSTRAINT table_user_email_key;
       public            postgres    false    216            0           2606    16405    table_user table_user_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.table_user
    ADD CONSTRAINT table_user_pkey PRIMARY KEY (id_user);
 D   ALTER TABLE ONLY public.table_user DROP CONSTRAINT table_user_pkey;
       public            postgres    false    216            2           2606    16407 "   table_user table_user_username_key 
   CONSTRAINT     a   ALTER TABLE ONLY public.table_user
    ADD CONSTRAINT table_user_username_key UNIQUE (username);
 L   ALTER TABLE ONLY public.table_user DROP CONSTRAINT table_user_username_key;
       public            postgres    false    216            9           2606    16417 2   table_gamearkanoid table_gamearkanoid_id_user_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.table_gamearkanoid
    ADD CONSTRAINT table_gamearkanoid_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.table_user(id_user) ON DELETE CASCADE;
 \   ALTER TABLE ONLY public.table_gamearkanoid DROP CONSTRAINT table_gamearkanoid_id_user_fkey;
       public          postgres    false    218    216    4656            ;           2606    16441 ,   table_gamesnake table_gamesnake_id_user_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.table_gamesnake
    ADD CONSTRAINT table_gamesnake_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.table_user(id_user) ON DELETE CASCADE;
 V   ALTER TABLE ONLY public.table_gamesnake DROP CONSTRAINT table_gamesnake_id_user_fkey;
       public          postgres    false    222    4656    216            :           2606    16429 .   table_gametetris table_gametetris_id_user_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.table_gametetris
    ADD CONSTRAINT table_gametetris_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.table_user(id_user) ON DELETE CASCADE;
 X   ALTER TABLE ONLY public.table_gametetris DROP CONSTRAINT table_gametetris_id_user_fkey;
       public          postgres    false    216    220    4656            �      x������ � �      �      x������ � �      �      x������ � �      �   n  x�e�͒�0 �3<�g��od��b�%$�q�0���3c���}�D���M����,�m��i5vxx(��-oO�x��I��?�X5�^�^ !/$R�ܟ'H��w��-�
-�?
�t��e[z��K������@0�_�6Lq�9����()r�Wҥ[��V,?ZYf>ֻ�mȀS����	+q���c<dh�p.CI�D^���>�ڜ\E΁�Q�E�Wh���(ޜ�xqDy6���T�1 k���kr��՗��;2]M�˸�JukF��ضfmc��:���xȠq�Q_��GYR����s��v�|J��F���DZ9i��E���9� ��N5��T��MM_��Ȳ��љ.     