<?php

namespace Database\Seeders;

use App\Models\Commerce;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllProductsSeeder extends Seeder
{
    // Pool de productos por categoría — cada comercio recibe 6 diferentes
    private function pool(string $category): array
    {
        return match ($category) {

            'comida' => [
                ['name'=>'Almuerzo del día','description'=>'Platillo completo: proteína a elección, arroz, ensalada, frijoles y bebida natural.','price'=>25,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Desayuno típico','description'=>'Huevos revueltos, frijoles volteados, crema, queso seco y 3 tortillas recién hechas.','price'=>18,'stock'=>60,'discount_percentage'=>0],
                ['name'=>'Caldo de res con verduras','description'=>'Caldo de res 500ml con papa, güisquil, ejote, elote y tortillas. Reconfortante y nutritivo.','price'=>35,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Pollo asado completo','description'=>'Medio pollo asado a la leña, papa al horno, ensalada y tortillas. Porción familiar.','price'=>45,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Churrasco con guarnición','description'=>'Corte de res a la parrilla 250g, chimichurri casero, papas fritas y ensalada fresca.','price'=>65,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Refresco natural 16oz','description'=>'Bebida de frutas frescas de temporada sin colorantes ni conservantes. Tamarindo, rosa de jamaica o maracuyá.','price'=>12,'stock'=>100,'discount_percentage'=>0],
            ],

            'ropa_a' => [
                ['name'=>'Camiseta básica cuello redondo','description'=>'Camiseta 100% algodón peinado 180g, corte regular fit, disponible en 10 colores surtidos.','price'=>45,'stock'=>60,'discount_percentage'=>0],
                ['name'=>'Jeans slim fit hombre','description'=>'Pantalón de mezclilla slim fit elastizado 2%, tiro medio, lavado stone washed moderno.','price'=>185,'stock'=>35,'discount_percentage'=>10],
                ['name'=>'Vestido floral manga corta','description'=>'Vestido casual de viscosa con estampado floral, elástico en cintura, ideal para verano.','price'=>145,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Blazer casual unisex negro','description'=>'Blazer de poliéster premium con forro parcial, 2 botones, bolsillos funcionales, corte moderno.','price'=>285,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Shorts deportivos','description'=>'Short de poliéster dry-fit con malla interior, bolsillos laterales y cintura elástica con cordón.','price'=>55,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Pack 5 calcetines surtidos','description'=>'Calcetines de algodón con lycra, corte tobillero, tallas 39-43, colores variados.','price'=>35,'stock'=>80,'discount_percentage'=>0],
            ],

            'ropa_b' => [
                ['name'=>'Camisa cuadros manga larga','description'=>'Camisa franela de algodón con estampado cuadros, bolsillo en pecho, corte regular.','price'=>125,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Pantalón chino beige','description'=>'Pantalón chino de algodón-elastano, tiro medio, corte slim, versátil para casual y formal.','price'=>165,'stock'=>28,'discount_percentage'=>5],
                ['name'=>'Falda midi plisada','description'=>'Falda midi de satén plisado hasta la rodilla, cintura elástica, cae perfecto y elegante.','price'=>95,'stock'=>22,'discount_percentage'=>0],
                ['name'=>'Sudadera con capucha','description'=>'Hoodie de felpa 300g con capucha ajustable, bolsillo canguro y puños acanalados.','price'=>155,'stock'=>40,'discount_percentage'=>10],
                ['name'=>'Leggings deportivos','description'=>'Leggins de licra 4 vías compresión media, tiro alto, con bolsillo lateral para celular.','price'=>85,'stock'=>45,'discount_percentage'=>0],
                ['name'=>'Vestido de noche elegante','description'=>'Vestido largo de gasa con escote en V, abertura lateral y forro interior, varios colores.','price'=>395,'stock'=>10,'discount_percentage'=>0],
            ],

            'ropa_c' => [
                ['name'=>'Polo bordado clásico','description'=>'Polo de piqué 220g con logo bordado, cuello con 3 botones, varios colores disponibles.','price'=>95,'stock'=>45,'discount_percentage'=>0],
                ['name'=>'Jeans recto negro','description'=>'Pantalón de mezclilla negro corte recto, tiro alto, bolsillos traseros y delanteros.','price'=>175,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Blusa de seda artificial','description'=>'Blusa de satén suave con lazo al frente, mangas largas con puño, ideal para oficina.','price'=>115,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Chaqueta denim clásica','description'=>'Chaqueta de mezclilla 12oz, lavado vintage, botones metálicos y bolsillos en pecho.','price'=>245,'stock'=>18,'discount_percentage'=>8],
                ['name'=>'Traje formal dos piezas','description'=>'Traje de poliéster-viscosa, saco y pantalón, solapa clásica, forro completo, varios talles.','price'=>685,'stock'=>8,'discount_percentage'=>0],
                ['name'=>'Pijama algodón suave','description'=>'Conjunto pijama camisa y pantalón de algodón 100%, suave y fresco para dormir.','price'=>125,'stock'=>35,'discount_percentage'=>0],
            ],

            'ropa_d' => [
                ['name'=>'Pack ropa interior x3','description'=>'Set 3 piezas de ropa interior de algodón-lycra, tallas S a XL, colores surtidos.','price'=>85,'stock'=>55,'discount_percentage'=>0],
                ['name'=>'Bata de baño microfibra','description'=>'Bata de microfibra absorbente, talla única, bolsillos profundos, cinturón ajustable.','price'=>145,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Camiseta estampada gráfica','description'=>'Camiseta de algodón con diseño gráfico urbano, corte oversize, cuello redondo reforzado.','price'=>65,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Blusa off-shoulder floral','description'=>'Blusa de escote descubierto con elástico, estampado floral, manga corta campana.','price'=>85,'stock'=>30,'discount_percentage'=>5],
                ['name'=>'Bufanda de invierno','description'=>'Bufanda de acrílico suave 180x30cm, tejido grueso, ideal para días fríos.','price'=>55,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Cinturón de cuero genuino','description'=>'Cinturón de cuero vacuno con hebilla plateada, ancho 3.5cm, tallas 30 a 40.','price'=>95,'stock'=>25,'discount_percentage'=>0],
            ],

            'electronica_a' => [
                ['name'=>'Smartphone Android 6.5" 64GB','description'=>'Celular Android con pantalla HD+ 6.5", cámara triple 48MP, batería 5000mAh y carga rápida 18W.','price'=>1450,'stock'=>12,'discount_percentage'=>0],
                ['name'=>'Auriculares inalámbricos Bluetooth','description'=>'Auriculares over-ear Bluetooth 5.0, 20h batería, plegables, con micrófono y control de volumen.','price'=>185,'stock'=>25,'discount_percentage'=>10],
                ['name'=>'Tablet 10" WiFi 32GB','description'=>'Tablet Android 10" Full HD, procesador octa-core, 3GB RAM, cámara 8MP, batería 6000mAh.','price'=>985,'stock'=>8,'discount_percentage'=>0],
                ['name'=>'Televisor LED 32" HD','description'=>'TV LED 32" HD Ready, HDMI x2, USB, sintonizador digital incorporado y control remoto.','price'=>1850,'stock'=>6,'discount_percentage'=>5],
                ['name'=>'Bocina Bluetooth portátil','description'=>'Altavoz inalámbrico 10W con resistencia al agua IPX5, 12h batería y micrófono integrado.','price'=>145,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Batería externa 20000mAh','description'=>'Power bank 20000mAh, carga rápida 18W, 2 salidas USB-A + USB-C, pantalla LED carga.','price'=>285,'stock'=>20,'discount_percentage'=>0],
            ],

            'electronica_b' => [
                ['name'=>'Audífonos con cable 3.5mm','description'=>'Auriculares intraurales con cable trenzado 1.2m, driver 10mm, respuesta 20Hz-20KHz.','price'=>45,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Radio AM/FM digital portátil','description'=>'Radio digital con pantalla LCD, 20 memorias, entrada USB, batería y alimentación AC/DC.','price'=>125,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Ventilador de mesa 12" 3 velocidades','description'=>'Ventilador eléctrico 12", 3 velocidades, ángulo ajustable 90°, silencioso, bajo consumo.','price'=>185,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Plancha de ropa a vapor 1800W','description'=>'Plancha con suela antiadherente cerámica, 1800W, 300ml depósito vapor continuo, punta fina.','price'=>195,'stock'=>18,'discount_percentage'=>8],
                ['name'=>'Cargador solar portátil 10000mAh','description'=>'Panel solar 5W + batería 10000mAh, 2 puertos USB, resistente al polvo y salpicaduras.','price'=>245,'stock'=>12,'discount_percentage'=>0],
                ['name'=>'Mini proyector portátil LED','description'=>'Proyector LED 150 lúmenes, HDMI+USB+AV, pantalla hasta 120", batería 2h autonomía.','price'=>585,'stock'=>5,'discount_percentage'=>0],
            ],

            'electronica_c' => [
                ['name'=>'Reloj digital de pared','description'=>'Reloj LED rojo 30cm, muestra hora y temperatura, alimentación 3xAA o USB, silencioso.','price'=>85,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Smartwatch básico notificaciones','description'=>'Reloj inteligente con notificaciones, podómetro, monitor de sueño, batería 7 días.','price'=>285,'stock'=>18,'discount_percentage'=>0],
                ['name'=>'Licuadora portátil USB 380ml','description'=>'Mini licuadora personal USB-C 380ml, 6 cuchillas inox, 25000 RPM, sin BPA, recargable.','price'=>145,'stock'=>22,'discount_percentage'=>0],
                ['name'=>'Teclado inalámbrico + mouse combo','description'=>'Combo teclado y mouse inalámbrico 2.4GHz, receptor nano único, pila incluida.','price'=>165,'stock'=>20,'discount_percentage'=>5],
                ['name'=>'Lámpara de escritorio LED USB','description'=>'Lámpara de cuello flexible USB, LED 5W, 3 temperaturas de color, control táctil.','price'=>75,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Robot aspiradora básico','description'=>'Aspiradora robótica 1200Pa, sensores anti-caída, silenciosa, ideal para pisos y alfombras.','price'=>485,'stock'=>7,'discount_percentage'=>10],
            ],

            'hogar_a' => [
                ['name'=>'Juego de sábanas matrimonial 300 hilos','description'=>'Set 4 piezas: sábana encimera, bajera con elástico y 2 fundas de almohada, algodón 300 hilos.','price'=>185,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Almohada memory foam standard','description'=>'Almohada de espuma viscoelástica 50x70cm, resistente al calor, funda de algodón desmontable.','price'=>145,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Toalla de baño 600g premium','description'=>'Toalla de algodón 600g/m² 70x140cm, suave y absorbente, varios colores, certificado Oeko-Tex.','price'=>65,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Set ollas inducción 5 piezas','description'=>'Juego de ollas aluminio antiadherente compatible con inducción, tapa de vidrio templado.','price'=>285,'stock'=>12,'discount_percentage'=>5],
                ['name'=>'Cortinas opacas 140x200cm (par)','description'=>'Par de cortinas blackout que bloquean el 99% de la luz, ojillos metálicos, varios colores.','price'=>165,'stock'=>18,'discount_percentage'=>0],
                ['name'=>'Espejo decorativo ovalado 60x40cm','description'=>'Espejo con marco de madera MDF laqueada, para sala, entrada o habitación, fácil instalación.','price'=>125,'stock'=>15,'discount_percentage'=>0],
            ],

            'hogar_b' => [
                ['name'=>'Set de vasos cristal (x6)','description'=>'Juego 6 vasos de vidrio templado 350ml, estilo moderno, aptos para lavavajillas.','price'=>85,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Organizador de cocina bambú','description'=>'Set 4 organizadores de bambu para cajones de cocina, ecológico, resistente a la humedad.','price'=>65,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Tapete de baño antideslizante','description'=>'Tapete de microfibra 50x80cm con base antideslizante, lavable a máquina, varios colores.','price'=>45,'stock'=>35,'discount_percentage'=>0],
                ['name'=>'Cojines decorativos (x2)','description'=>'Par de cojines decorativos 45x45cm con funda de terciopelo, relleno de fibra siliconada.','price'=>95,'stock'=>20,'discount_percentage'=>10],
                ['name'=>'Set de platos cerámica (x6)','description'=>'Juego 6 platos de cerámica 27cm, aptos para microondas y lavavajillas, diseño minimalista.','price'=>145,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Cuadro decorativo moderno 60x40','description'=>'Cuadro impresión artística sobre lienzo canvas con bastidor, temática abstracta o naturaleza.','price'=>85,'stock'=>22,'discount_percentage'=>0],
            ],

            'hogar_c' => [
                ['name'=>'Set de cuchillos cocina (x5)','description'=>'Juego de cuchillos de acero inoxidable alemán con mango de madera, corte preciso y duradero.','price'=>185,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Alfombra sala 120x180cm','description'=>'Alfombra de pelo corto 10mm, antideslizante, lavable, diseño geométrico moderno.','price'=>245,'stock'=>10,'discount_percentage'=>0],
                ['name'=>'Canasta de mimbre decorativa','description'=>'Cesta tejida a mano con asa de cuero, para organizar juguetes, ropa o plantas.','price'=>65,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Jabonera dispensadora 400ml','description'=>'Dispensador de jabón líquido de cerámica blanca, bomba de acero inoxidable, sin BPA.','price'=>45,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Velador lámpara de noche','description'=>'Lámpara de mesa con base de cerámica y pantalla de tela, E27 LED 7W incluido, ambiente cálido.','price'=>125,'stock'=>18,'discount_percentage'=>5],
                ['name'=>'Cesto ropa sucia plegable 80L','description'=>'Cesto de tela oxford 80L con tapa y asas, plegable, estructura de bambú, fácil lavado.','price'=>55,'stock'=>30,'discount_percentage'=>0],
            ],

            'supermercado_a' => [
                ['name'=>'Arroz blanco 5lb','description'=>'Arroz blanco de grano largo seleccionado, limpio y clasificado, libre de impurezas.','price'=>22,'stock'=>150,'discount_percentage'=>0],
                ['name'=>'Aceite vegetal premium 1L','description'=>'Aceite vegetal 100% de soya o girasol, 0% colesterol, ideal para freír y cocinar.','price'=>18,'stock'=>120,'discount_percentage'=>0],
                ['name'=>'Frijoles negros 1lb','description'=>'Frijol negro de primera calidad, seleccionado y limpio, sin piedras, para cocinar al gusto.','price'=>12,'stock'=>200,'discount_percentage'=>0],
                ['name'=>'Azúcar morena 2lb','description'=>'Azúcar morena sin refinar con melaza natural, sabor intenso, ideal para repostería.','price'=>14,'stock'=>180,'discount_percentage'=>0],
                ['name'=>'Pasta spaghetti 500g','description'=>'Spaghetti de sémola de trigo duro, cocción al dente 8 minutos, sin colorantes artificiales.','price'=>12,'stock'=>160,'discount_percentage'=>0],
                ['name'=>'Leche entera UHT 1L','description'=>'Leche entera ultrapasteurizada 3.5% grasa, vitaminas A y D, larga duración sin refrigerar.','price'=>14,'stock'=>200,'discount_percentage'=>0],
            ],

            'supermercado_b' => [
                ['name'=>'Atún en agua (x3 latas 160g)','description'=>'Atún en trozos en agua natural, rico en proteína y omega-3, sin conservantes artificiales.','price'=>35,'stock'=>100,'discount_percentage'=>0],
                ['name'=>'Sal marina 1kg','description'=>'Sal marina gruesa o fina, yodada y fluorada según normativa, sin aditivos artificiales.','price'=>8,'stock'=>200,'discount_percentage'=>0],
                ['name'=>'Jabón de lavar (x3 barras 200g)','description'=>'Jabón de lavandería con fórmula activa antigrasa, aroma limón, para ropa blanca y de color.','price'=>18,'stock'=>150,'discount_percentage'=>0],
                ['name'=>'Papel higiénico (x12 rollos)','description'=>'Papel higiénico doble hoja, 200 hojas por rollo, suave y resistente, sin blanqueadores ópticos.','price'=>35,'stock'=>120,'discount_percentage'=>0],
                ['name'=>'Detergente ropa en polvo 1kg','description'=>'Detergente con enzimas anti-manchas, activo en agua fría, apto para lavadora y lavado a mano.','price'=>28,'stock'=>130,'discount_percentage'=>0],
                ['name'=>'Café molido 250g','description'=>'Café 100% guatemalteco de origen Huehuetenango, tostado medio, aroma intenso y sabor suave.','price'=>32,'stock'=>90,'discount_percentage'=>0],
            ],

            'supermercado_c' => [
                ['name'=>'Harina de trigo especial 1kg','description'=>'Harina de trigo todo uso, perfecta para panes, tortillas, pasteles y repostería en general.','price'=>12,'stock'=>180,'discount_percentage'=>0],
                ['name'=>'Cereal avena en hojuelas 500g','description'=>'Avena integral sin azúcar añadida, alta en fibra, ideal para desayuno o batidos nutritivos.','price'=>18,'stock'=>120,'discount_percentage'=>0],
                ['name'=>'Galletas soda (x3 paquetes)','description'=>'Galletas de soda crujientes de trigo, sin colesterol, perfectas para snack o acompañar sopas.','price'=>15,'stock'=>150,'discount_percentage'=>0],
                ['name'=>'Jugo de naranja natural 1L','description'=>'Jugo de naranja 100% natural sin concentrados, sin azúcar añadida, refrigerado fresco.','price'=>22,'stock'=>80,'discount_percentage'=>0],
                ['name'=>'Agua purificada bidón 6L','description'=>'Agua purificada por ósmosis inversa y ozono, libre de cloro y metales pesados.','price'=>12,'stock'=>200,'discount_percentage'=>0],
                ['name'=>'Mantequilla sin sal 250g','description'=>'Mantequilla de crema de leche 82% grasa, sin sal, ideal para repostería y untar caliente.','price'=>28,'stock'=>90,'discount_percentage'=>0],
            ],

            'deportes_a' => [
                ['name'=>'Balón de fútbol #5 oficial','description'=>'Balón tamaño oficial #5, cubierta PU termolaminada, cámara de butilo, 32 paneles cosidos.','price'=>85,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Guantes de boxeo 12oz','description'=>'Guantes de cuero sintético con espuma de alta densidad, velcro ajustable, suela acolchada.','price'=>125,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Zapatillas running unisex','description'=>'Tenis deportivos con suela de goma antideslizante, plantilla extraíble, upper de malla transpirable.','price'=>285,'stock'=>20,'discount_percentage'=>10],
                ['name'=>'Cuerda de saltar profesional','description'=>'Cuerda de velocidad con rodamientos, mangos ergonómicos de aluminio, ajustable hasta 3 metros.','price'=>45,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Mancuernas 2kg (par)','description'=>'Par de mancuernas de 2kg revestidas en neopreno antideslizante, diseño ergonómico hexagonal.','price'=>65,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Mat de yoga antideslizante 6mm','description'=>'Esterilla de yoga TPE ecológica 183x61cm, 6mm espesor, doble cara, con bolsa de transporte.','price'=>95,'stock'=>22,'discount_percentage'=>0],
            ],

            'deportes_b' => [
                ['name'=>'Camiseta deportiva dry-fit','description'=>'Camiseta técnica de poliéster dry-fit con tecnología anti-olor, corte slim, secado ultrarápido.','price'=>55,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Short deportivo con bolsillos','description'=>'Short de poliéster 4 vías, cintura elástica con cordón, bolsillos laterales y bolsillo trasero.','price'=>45,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Pesas tobilleras 1kg (par)','description'=>'Par de pesas para tobillo/muñeca de 1kg, neopreno suave, velcro ajustable, lavables.','price'=>55,'stock'=>35,'discount_percentage'=>0],
                ['name'=>'Botella deportiva 1L libre BPA','description'=>'Botella de tritán libre de BPA, tapa tipo push-pull, con marcas de medición y asa lateral.','price'=>35,'stock'=>55,'discount_percentage'=>0],
                ['name'=>'Guantes fitness gym','description'=>'Guantes de entrenamiento con refuerzo en palma, velcro en muñeca, absorbe impacto en pesas.','price'=>45,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Banda elástica resistencia media','description'=>'Banda de látex natural resistencia media (15-20kg), para glúteos, piernas y rehabilitación.','price'=>35,'stock'=>45,'discount_percentage'=>0],
            ],

            'belleza_a' => [
                ['name'=>'Labial mate larga duración','description'=>'Labial de larga duración 8h con fórmula hidratante, acabado mate aterciopelado, 12 tonos.','price'=>45,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Paleta sombras 12 colores','description'=>'Paleta de eyeshadow con colores mate y shimmer, altamente pigmentada, sin caída de pigmento.','price'=>85,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Mascarilla facial de arcilla','description'=>'Mascarilla purificante de arcilla caolín con carbón activado, limpia poros en profundidad.','price'=>55,'stock'=>35,'discount_percentage'=>0],
                ['name'=>'Perfume floral mujer 60ml','description'=>'Eau de parfum con notas de jazmín, rosa y sándalo, 60ml, duración 8-10 horas en piel.','price'=>185,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Base de maquillaje SPF15','description'=>'Base de cobertura media a total con filtro solar SPF15, fórmula larga duración sin transferencia.','price'=>95,'stock'=>30,'discount_percentage'=>10],
                ['name'=>'Sérum vitamina C 30ml','description'=>'Sérum facial con 15% de vitamina C estabilizada, ilumina, unifica y protege contra radicales libres.','price'=>145,'stock'=>20,'discount_percentage'=>0],
            ],

            'belleza_b' => [
                ['name'=>'Rubor en polvo coral','description'=>'Blush compacto de textura sedosa, fórmula buildable, pincel incluido, 5 tonos disponibles.','price'=>65,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Delineador líquido negro','description'=>'Delineador de punta fina de fieltro, fórmula waterproof, negro intenso, dura 24 horas.','price'=>35,'stock'=>45,'discount_percentage'=>0],
                ['name'=>'Desmaquillante bifásico 200ml','description'=>'Agua micelar bifásica que elimina maquillaje resistente al agua sin frotar ni irritar.','price'=>55,'stock'=>35,'discount_percentage'=>0],
                ['name'=>'Rizador de cabello 25mm','description'=>'Tenacillas de 25mm con revestimiento cerámico, 5 temperaturas hasta 210°C, iónico anti-frizz.','price'=>185,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Plancha de pelo titanio','description'=>'Plancha de titanio con flotante 3D, calentamiento instantáneo 30s, hasta 230°C, pantalla LED.','price'=>245,'stock'=>10,'discount_percentage'=>5],
                ['name'=>'Gel de baño hidratante 500ml','description'=>'Gel de ducha con manteca de karité y vitamina E, pH balanceado, aroma floral suave.','price'=>45,'stock'=>50,'discount_percentage'=>0],
            ],

            'juguetes_a' => [
                ['name'=>'Set bloques construcción 200 piezas','description'=>'Bloques de plástico compatibles con Lego, 200 piezas en colores vivos, para niños 4+ años.','price'=>85,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Muñeca articulada con accesorios','description'=>'Muñeca 30cm totalmente articulada con ropa y accesorios intercambiables, pelo real peinnable.','price'=>65,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Carro de control remoto','description'=>'Auto RC con 4 direcciones, velocidad 15km/h, batería recargable 40min uso y control 30m.','price'=>125,'stock'=>15,'discount_percentage'=>10],
                ['name'=>'Rompecabezas 500 piezas','description'=>'Puzzle de 500 piezas con imagen de paisaje o fauna guatemalteca, tamaño final 47x33cm.','price'=>45,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Juego de mesa familiar','description'=>'Juego de mesa para 2-6 jugadores mayores de 6 años, dinámico, educativo y divertido.','price'=>55,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Pelota saltarina 60cm','description'=>'Balón inflable de PVC resistente 60cm para niños 3-8 años, con asa de agarre, varios colores.','price'=>35,'stock'=>40,'discount_percentage'=>0],
            ],

            'juguetes_b' => [
                ['name'=>'Pizarrón magnético doble cara','description'=>'Pizarrón infantil doble: tiza y marcador, con atril ajustable y accesorios educativos incluidos.','price'=>125,'stock'=>12,'discount_percentage'=>0],
                ['name'=>'Set cocina de juguete 25 piezas','description'=>'Cocinita de plástico con 25 accesorios: ollas, utensilios, frutas y verduras realistas.','price'=>95,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Patineta mini junior 43cm','description'=>'Patineta de madera de arce 7 capas 43cm, ruedas PU 50mm, para aprendizaje básico.','price'=>75,'stock'=>18,'discount_percentage'=>0],
                ['name'=>'Set pinturas y dibujo 28 piezas','description'=>'Kit artístico con acuarelas, crayones, plumones, pinceles y libreta de dibujo.','price'=>45,'stock'=>30,'discount_percentage'=>5],
                ['name'=>'Globos metálicos surtidos (x20)','description'=>'Pack 20 globos metálicos de látex en colores y formas surtidas, para fiestas y decoración.','price'=>18,'stock'=>100,'discount_percentage'=>0],
                ['name'=>'Plastilina colores (x10 barras)','description'=>'Set 10 colores de plastilina no tóxica, no se seca al contacto con el aire, moldeable.','price'=>22,'stock'=>60,'discount_percentage'=>0],
            ],

            'mascotas_a' => [
                ['name'=>'Alimento seco perro adulto 2kg','description'=>'Croquetas para perro adulto razas medianas, proteína de pollo 24%, omega 3 y 6, sin colorantes.','price'=>65,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Alimento seco gato adulto 1.5kg','description'=>'Croquetas premium para gato adulto, proteína de salmón 30%, control de bolas de pelo.','price'=>55,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Correa retráctil 5m hasta 25kg','description'=>'Correa extensible de nylon 5m para perros hasta 25kg, con freno de seguridad y gancho giratorio.','price'=>85,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Cama mascota talla M 60x50cm','description'=>'Cama acolchada con borde elevado para perros y gatos talla M, funda lavable a máquina.','price'=>95,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Juguete hueso goma mordible','description'=>'Hueso de caucho natural resistente para perros mordedores, limpia dientes, sin BPA.','price'=>25,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Champú antipulgas 300ml','description'=>'Shampoo antiparasitario con extracto de neem y citronela, actúa contra pulgas y garrapatas.','price'=>35,'stock'=>40,'discount_percentage'=>0],
            ],

            'mascotas_b' => [
                ['name'=>'Arena sanitaria gato aglomerante 4kg','description'=>'Arena de bentonita aglomerante sin polvo, control de olores 7 días, fácil limpieza.','price'=>45,'stock'=>35,'discount_percentage'=>0],
                ['name'=>'Tazón acero doble 2x400ml','description'=>'Comedero/bebedero doble de acero inoxidable con base de goma antideslizante, fácil lavado.','price'=>35,'stock'=>40,'discount_percentage'=>0],
                ['name'=>'Collar ajustable con chapa ID','description'=>'Collar de nylon ajustable con chapa de identificación grabable, reflectante, talla S a L.','price'=>25,'stock'=>50,'discount_percentage'=>0],
                ['name'=>'Premio snack dental perro (x20)','description'=>'Snacks dentales en forma de hueso, reduce el sarro, limpia el aliento, con menta natural.','price'=>28,'stock'=>60,'discount_percentage'=>0],
                ['name'=>'Transportadora perro/gato talla M','description'=>'Caja transportadora plástico rígido con rejillas de ventilación, puerta metálica, asa integrada.','price'=>125,'stock'=>12,'discount_percentage'=>0],
                ['name'=>'Vitaminas pelo y uñas mascotas','description'=>'Suplemento en perlas de aceite de salmón para piel brillante y uñas fuertes en perros y gatos.','price'=>45,'stock'=>30,'discount_percentage'=>5],
            ],

            'libros_a' => [
                ['name'=>'Biblia Reina Valera letra grande','description'=>'Biblia RV60 letra grande tapa dura con índice, concordancia y mapas a color, pasta flexible.','price'=>95,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Atomic Habits — James Clear','description'=>'El método probado para adquirir buenos hábitos y eliminar los malos. Bestseller mundial 2024.','price'=>85,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'El Alquimista — Paulo Coelho','description'=>'La novela más leída en la historia latinoamericana. Edición de aniversario con prólogo del autor.','price'=>65,'stock'=>30,'discount_percentage'=>0],
                ['name'=>'Cien años de soledad — García Márquez','description'=>'Obra cumbre del realismo mágico latinoamericano. Edición conmemorativa con prólogo de Mario Vargas Llosa.','price'=>95,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Atlas geográfico universal ilustrado','description'=>'Atlas con 300 mapas actualizados, datos demográficos, relieve e información de todos los países.','price'=>125,'stock'=>12,'discount_percentage'=>0],
                ['name'=>'Libro de recetas guatemaltecas','description'=>'80 recetas tradicionales guatemaltecas con fotografías, historia de cada platillo e ingredientes.','price'=>75,'stock'=>18,'discount_percentage'=>0],
            ],

            'libros_b' => [
                ['name'=>'Diccionario español completo 1800 páginas','description'=>'Diccionario de la lengua española 1800 páginas, 80,000 entradas, etimología y ejemplos de uso.','price'=>85,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Los 7 hábitos — Stephen Covey','description'=>'Manual de desarrollo personal y liderazgo. Edición ilustrada con ejercicios prácticos.','price'=>75,'stock'=>20,'discount_percentage'=>0],
                ['name'=>'Inteligencia emocional — Goleman','description'=>'El clásico de Goleman sobre IE, habilidades sociales y éxito personal. Edición actualizada 2024.','price'=>75,'stock'=>18,'discount_percentage'=>0],
                ['name'=>'Enciclopedia ilustrada para niños','description'=>'Enciclopedia 400 páginas con ciencia, naturaleza, historia y arte, para niños 8-14 años.','price'=>145,'stock'=>10,'discount_percentage'=>0],
                ['name'=>'Don Quijote de la Mancha — Cervantes','description'=>'Edición abreviada y anotada para jóvenes lectores con ilustraciones originales en cada capítulo.','price'=>55,'stock'=>25,'discount_percentage'=>0],
                ['name'=>'Historia de Guatemala ilustrada','description'=>'Recorrido histórico desde los mayas hasta la actualidad con fotografías, mapas y cronología.','price'=>95,'stock'=>12,'discount_percentage'=>0],
            ],

            'muebles_a' => [
                ['name'=>'Silla de oficina giratoria ergonómica','description'=>'Silla ejecutiva con respaldo lumbar ajustable, apoyabrazos 3D, ruedas silenciosas y pistón clase 4.','price'=>685,'stock'=>8,'discount_percentage'=>0],
                ['name'=>'Mesa de centro vidrio y metal 100x50','description'=>'Mesa de centro marco de metal negro con tablero de vidrio templado 8mm, 100x50x45cm.','price'=>485,'stock'=>6,'discount_percentage'=>5],
                ['name'=>'Estante 5 niveles melamina blanco','description'=>'Librero de melamina 5 estantes, 180x60x30cm, fácil armado, soporta 25kg por estante.','price'=>285,'stock'=>10,'discount_percentage'=>0],
                ['name'=>'Sofá 3 plazas tela gris','description'=>'Sofá de 3 cuerpos tapizado en tela poliester gris, patas de madera maciza, cojines firmes.','price'=>1850,'stock'=>4,'discount_percentage'=>0],
                ['name'=>'Escritorio en L melamina wengue','description'=>'Escritorio esquinero 140x120cm, cajonera lateral con llave, soporte para monitor incluido.','price'=>985,'stock'=>5,'discount_percentage'=>0],
                ['name'=>'Cama matrimonial 1.40m con cajones','description'=>'Base de cama matrimonial de madera MDF con 4 cajones de almacenamiento lateral, 1.40x1.90m.','price'=>1250,'stock'=>4,'discount_percentage'=>0],
            ],

            'muebles_b' => [
                ['name'=>'Silla comedor madera (x4 unidades)','description'=>'Set 4 sillas de comedor de madera sólida con asiento tapizado en tela, apilables.','price'=>685,'stock'=>5,'discount_percentage'=>0],
                ['name'=>'Mesa de comedor 6 personas','description'=>'Mesa rectangular de madera de pino 160x80cm, acabado natural, patas torneadas reforzadas.','price'=>985,'stock'=>4,'discount_percentage'=>0],
                ['name'=>'Closet 2 puertas correderas espejo','description'=>'Armario 2 puertas correderas con espejo full, interior con barra y 4 estantes, 150x200x60cm.','price'=>1450,'stock'=>3,'discount_percentage'=>10],
                ['name'=>'Mesita de noche 2 cajones','description'=>'Mesa de noche de madera MDF con 2 cajones y ranura USB para carga, 45x35x55cm.','price'=>285,'stock'=>8,'discount_percentage'=>0],
                ['name'=>'Repisa flotante 80cm madera rústica','description'=>'Estante de madera maciza 80x20cm con soporte metálico invisible, soporta 20kg, fácil montaje.','price'=>95,'stock'=>15,'discount_percentage'=>0],
                ['name'=>'Banco tapizado sala','description'=>'Banco auxiliar tapizado en terciopelo 90x35x45cm, patas de madera, para sala o dormitorio.','price'=>285,'stock'=>7,'discount_percentage'=>0],
            ],
        };
    }

    public function run(): void
    {
        // 1. Limpiar imágenes de TODOS los productos existentes
        DB::table('products')->update(['image' => null]);
        $this->command->info('Imágenes eliminadas de todos los productos.');

        // 2. Definir productos por comercio para los que ya tenían pero incompletos o con datos previos
        // Limpiar y repoblar Comedor La Bendición
        $this->repopulateCommerce('Comedor La Bendición', 'comida');

        // 3. Poblar todas las categorías sin productos
        //    ROPA (cat 2)
        $ropaGroups = ['ropa_a', 'ropa_b', 'ropa_c', 'ropa_d'];
        $this->populateCategory(2, $ropaGroups);

        //    ELECTRÓNICA (cat 4) + CompuCenter de Tecnología (cat 3) sin productos
        $techGroups = ['electronica_a', 'electronica_b', 'electronica_c'];
        $this->populateCategory(4, $techGroups);

        // CompuCenter cat=3 sin productos
        $this->repopulateCommerce('CompuCenter', 'electronica_a', 3);

        //    HOGAR (cat 6)
        $hogarGroups = ['hogar_a', 'hogar_b', 'hogar_c'];
        $this->populateCategory(6, $hogarGroups);

        //    SUPERMERCADO (cat 7)
        $superGroups = ['supermercado_a', 'supermercado_b', 'supermercado_c'];
        $this->populateCategory(7, $superGroups);

        //    DEPORTES (cat 8)
        $deportesGroups = ['deportes_a', 'deportes_b'];
        $this->populateCategory(8, $deportesGroups);

        //    BELLEZA (cat 9)
        $bellezaGroups = ['belleza_a', 'belleza_b'];
        $this->populateCategory(9, $bellezaGroups);

        //    JUGUETES (cat 10)
        $juguetesGroups = ['juguetes_a', 'juguetes_b'];
        $this->populateCategory(10, $juguetesGroups);

        //    MASCOTAS (cat 11)
        $mascotasGroups = ['mascotas_a', 'mascotas_b'];
        $this->populateCategory(11, $mascotasGroups);

        //    LIBROS (cat 12)
        $librosGroups = ['libros_a', 'libros_b'];
        $this->populateCategory(12, $librosGroups);

        //    MUEBLES (cat 13)
        $mueblesGroups = ['muebles_a', 'muebles_b'];
        $this->populateCategory(13, $mueblesGroups);

        $total = DB::table('products')->count();
        $this->command->info("Total productos en BD: {$total}");
    }

    private function populateCategory(int $categoryId, array $poolKeys): void
    {
        $commerces = Commerce::where('category_id', $categoryId)
            ->where('status', 'activo')
            ->whereDoesntHave('products')
            ->orderBy('id')
            ->get();

        if ($commerces->isEmpty()) {
            $this->command->warn("  Cat {$categoryId}: todos tienen productos.");
            return;
        }

        foreach ($commerces as $i => $commerce) {
            $poolKey = $poolKeys[$i % count($poolKeys)];
            $products = $this->pool($poolKey);

            // Rotar el pool para que cada comercio tenga variedad diferente
            $offset = ($i * 2) % count($products);
            $rotated = array_merge(
                array_slice($products, $offset),
                array_slice($products, 0, $offset)
            );
            $selected = array_slice($rotated, 0, 6);

            $rows = array_map(fn($p) => array_merge($p, [
                'commerce_id' => $commerce->id,
                'image'       => null,
                'status'      => 'activo',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]), $selected);

            DB::table('products')->insert($rows);
            $this->command->info("  ✓ {$commerce->name} — 6 productos");
        }
    }

    private function repopulateCommerce(string $name, string $poolKey, ?int $categoryId = null): void
    {
        $query = Commerce::where('name', $name);
        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }
        $commerce = $query->first();

        if (! $commerce) {
            $this->command->warn("No encontrado: {$name}");
            return;
        }

        // Solo repoblar si tiene menos de 6 productos
        if ($commerce->products()->count() >= 6) {
            $this->command->info("  ✓ {$name} ya tiene suficientes productos.");
            return;
        }

        DB::table('products')->where('commerce_id', $commerce->id)->delete();

        $products = $this->pool($poolKey);
        $rows = array_map(fn($p) => array_merge($p, [
            'commerce_id' => $commerce->id,
            'image'       => null,
            'status'      => 'activo',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]), array_slice($products, 0, 6));

        DB::table('products')->insert($rows);
        $this->command->info("  ✓ {$name} — 6 productos");
    }
}
