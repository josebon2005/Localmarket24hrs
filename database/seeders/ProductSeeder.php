<?php

namespace Database\Seeders;

use App\Models\Commerce;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // URL fija por keyword+lock: misma imagen siempre, relevante al producto
        $img = fn(string $kw, int $lock) => "https://loremflickr.com/480/360/{$kw}?lock={$lock}";

        $catalog = [

            // ═══════════════════════════════════════════
            // AUTOMOTRIZ
            // ═══════════════════════════════════════════
            'Auto Repuestos GT' => [
                ['name'=>'Aceite Motor 10W-40 1L','description'=>'Aceite sintético de alta performance para motores modernos gasolina y diesel.','price'=>45,'stock'=>80,'image'=>$img('engine,oil,motor',1),'discount_percentage'=>0],
                ['name'=>'Filtro de aceite universal','description'=>'Filtro de aceite compatible con la mayoría de motores 1.0 a 2.0 litros.','price'=>35,'stock'=>60,'image'=>$img('oil,filter,automotive',2),'discount_percentage'=>0],
                ['name'=>'Pastillas de freno delanteras','description'=>'Pastillas de freno cerámicas de alto rendimiento, baja emisión de polvo.','price'=>185,'stock'=>30,'image'=>$img('brake,disc,car',3),'discount_percentage'=>10],
                ['name'=>'Filtro de aire premium','description'=>'Filtro de aire de alto flujo, mejora el rendimiento del motor hasta un 5%.','price'=>65,'stock'=>45,'image'=>$img('air,filter,intake',4),'discount_percentage'=>0],
                ['name'=>'Batería 60Ah / 12V','description'=>'Batería libre de mantenimiento con 18 meses de garantía, arranque potente.','price'=>650,'stock'=>15,'image'=>$img('car,battery,12v',5),'discount_percentage'=>5],
                ['name'=>'Kit de luces LED H4','description'=>'Kit de conversión LED H4 6000K, 6000 lúmenes por par, plug and play.','price'=>120,'stock'=>25,'image'=>$img('led,headlight,car',6),'discount_percentage'=>0],
            ],
            'Motores Express' => [
                ['name'=>'Bomba de agua universal','description'=>'Bomba de agua de aluminio reforzado, compatible con múltiples modelos japoneses y coreanos.','price'=>280,'stock'=>20,'image'=>$img('water,pump,engine',7),'discount_percentage'=>0],
                ['name'=>'Termostato de motor','description'=>'Termostato 82°C con empaque incluido, controla la temperatura óptima del motor.','price'=>95,'stock'=>35,'image'=>$img('engine,thermostat,cooling',8),'discount_percentage'=>0],
                ['name'=>'Correa de distribución kit','description'=>'Kit de correa de distribución con tensor y bomba de agua. Recambio cada 80,000 km.','price'=>145,'stock'=>18,'image'=>$img('timing,belt,engine',9),'discount_percentage'=>8],
                ['name'=>'Amortiguador delantero','description'=>'Amortiguador de gas presurizado, suavidad y control superior en cualquier terreno.','price'=>420,'stock'=>12,'image'=>$img('shock,absorber,suspension',10),'discount_percentage'=>0],
                ['name'=>'Bujías NGK (juego x4)','description'=>'Bujías de iridio de larga duración, mejor combustión y arranque en frío.','price'=>80,'stock'=>50,'image'=>$img('spark,plug,ignition',11),'discount_percentage'=>0],
                ['name'=>'Alternador reconstruido','description'=>'Alternador reconstruido 90A con garantía 6 meses, carga eficiente la batería.','price'=>850,'stock'=>8,'image'=>$img('alternator,generator,car',12),'discount_percentage'=>0],
            ],
            'Car Wash Premium' => [
                ['name'=>'Shampoo para auto 1L','description'=>'Shampoo neutro pH6, formula concentrada, produce abundante espuma y elimina grasa.','price'=>55,'stock'=>70,'image'=>$img('car,wash,foam,soap',13),'discount_percentage'=>0],
                ['name'=>'Cera protectora carnauba','description'=>'Cera de carnauba natural, protege la pintura de rayos UV y lluvia ácida por 3 meses.','price'=>85,'stock'=>45,'image'=>$img('car,wax,polish,shine',14),'discount_percentage'=>15],
                ['name'=>'Microfibra premium (x3 paños)','description'=>'Paños de microfibra 400gsm ultra suaves, no rayan la pintura y absorben 8 veces su peso.','price'=>45,'stock'=>60,'image'=>$img('microfiber,cloth,car,cleaning',15),'discount_percentage'=>0],
                ['name'=>'Desengrasante motor potente','description'=>'Desengrasante profesional en spray, elimina grasa y aceite del motor en minutos.','price'=>35,'stock'=>55,'image'=>$img('degreaser,spray,engine,cleaning',16),'discount_percentage'=>0],
                ['name'=>'Silicona para tablero','description'=>'Silicona protectora mate para tablero y plásticos interiores, efecto antireflejo.','price'=>28,'stock'=>80,'image'=>$img('car,dashboard,interior,clean',17),'discount_percentage'=>0],
                ['name'=>'Kit limpieza interior completo','description'=>'Kit 6 piezas: shampoo interior, silicona, limpiador vidrios, aromatizante y 2 paños.','price'=>150,'stock'=>20,'image'=>$img('car,interior,cleaning,kit',18),'discount_percentage'=>10],
            ],
            'Llantas del Norte' => [
                ['name'=>'Llanta 195/65R15','description'=>'Llanta radial todo terreno, bajo ruido y excelente agarre en pavimento mojado.','price'=>485,'stock'=>20,'image'=>$img('tire,car,wheel,rubber',19),'discount_percentage'=>0],
                ['name'=>'Llanta 205/55R16','description'=>'Llanta de alto rendimiento para vehículos medianos y sedanes deportivos.','price'=>520,'stock'=>16,'image'=>$img('tyre,alloy,rim,sports',20),'discount_percentage'=>5],
                ['name'=>'Llanta 175/70R13','description'=>'Llanta económica de larga duración para vehículos compactos y pequeños.','price'=>395,'stock'=>24,'image'=>$img('tire,compact,car,rubber',21),'discount_percentage'=>0],
                ['name'=>'Servicio alineación + balanceo','description'=>'Servicio completo de alineación computarizada y balanceo para los 4 neumáticos.','price'=>120,'stock'=>100,'image'=>$img('wheel,alignment,balancing,garage',22),'discount_percentage'=>0],
                ['name'=>'Válvulas de llanta (x4)','description'=>'Válvulas metálicas cromadas con tapa anti-polvo, compatibles con todos los aros.','price'=>25,'stock'=>200,'image'=>$img('tire,valve,stem,wheel',23),'discount_percentage'=>0],
                ['name'=>'Kit reparación pinchazos','description'=>'Kit de emergencia con 4 tapones, herramienta de inserción y compresor 12V portátil.','price'=>185,'stock'=>30,'image'=>$img('flat,tire,repair,kit',24),'discount_percentage'=>0],
            ],
            'Accesorios Racing' => [
                ['name'=>'Volante deportivo 14"','description'=>'Volante deportivo de cuero genuino 350mm, grip mejorado, compatible con bosskit.','price'=>350,'stock'=>12,'image'=>$img('racing,steering,wheel,sport',25),'discount_percentage'=>0],
                ['name'=>'Tapetes de hule 3D (x4)','description'=>'Tapetes de hule resistente con bordón, ajuste exacto al piso del vehículo.','price'=>95,'stock'=>30,'image'=>$img('car,floor,mat,rubber',26),'discount_percentage'=>0],
                ['name'=>'Funda asiento racing','description'=>'Funda de asiento estilo racing en tejido transpirable, universal para sedanes y SUV.','price'=>220,'stock'=>18,'image'=>$img('car,seat,cover,racing',27),'discount_percentage'=>12],
                ['name'=>'Purificador de aire auto','description'=>'Mini purificador HEPA para autos, elimina el 99.9% de bacterias y malos olores.','price'=>65,'stock'=>40,'image'=>$img('car,air,purifier,freshener',28),'discount_percentage'=>0],
                ['name'=>'Soporte celular magnético','description'=>'Soporte magnético giratorio 360° para rejillas de ventilación, sujeta hasta 300g.','price'=>45,'stock'=>60,'image'=>$img('phone,mount,car,magnetic',29),'discount_percentage'=>0],
                ['name'=>'Cargador 12V doble USB 3.4A','description'=>'Cargador de encendedor con doble USB 3.4A total, carga rápida para dos dispositivos.','price'=>35,'stock'=>75,'image'=>$img('car,charger,usb,cigarette',30),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // FARMACIA
            // ═══════════════════════════════════════════
            'Farmacia Salud Total' => [
                ['name'=>'Paracetamol 500mg (x10 tabs)','description'=>'Analgésico y antipirético de acción rápida. Alivia dolor de cabeza, muscular y fiebre.','price'=>12,'stock'=>200,'image'=>$img('medicine,pills,tablet,paracetamol',31),'discount_percentage'=>0],
                ['name'=>'Ibuprofeno 400mg (x12 tabs)','description'=>'Antiinflamatorio no esteroideo. Alivia dolor, inflamación y fiebre en adultos.','price'=>18,'stock'=>180,'image'=>$img('ibuprofen,medication,tablets,pharmacy',32),'discount_percentage'=>0],
                ['name'=>'Vitamina C 1000mg (x30 tabs)','description'=>'Vitamina C efervescente de alta dosis, refuerza el sistema inmune y combate el estrés oxidativo.','price'=>55,'stock'=>120,'image'=>$img('vitamin,c,supplement,effervescent',33),'discount_percentage'=>0],
                ['name'=>'Tensiómetro digital automático','description'=>'Tensiómetro de muñeca automático con pantalla grande, memoria 60 lecturas y detección de arritmia.','price'=>285,'stock'=>25,'image'=>$img('blood,pressure,monitor,digital',34),'discount_percentage'=>10],
                ['name'=>'Termómetro digital infrarrojo','description'=>'Termómetro sin contacto, resultado en 1 segundo, alarma de fiebre, apto para bebés.','price'=>75,'stock'=>40,'image'=>$img('thermometer,digital,infrared,temperature',35),'discount_percentage'=>0],
                ['name'=>'Alcohol gel antibacterial 500ml','description'=>'Gel antiséptico con 70% de alcohol isopropílico, fórmula con aloe vera hidratante.','price'=>32,'stock'=>150,'image'=>$img('hand,sanitizer,gel,antibacterial',36),'discount_percentage'=>0],
            ],
            'Farmacia Central' => [
                ['name'=>'Loratadina 10mg (x10 tabs)','description'=>'Antihistamínico de segunda generación, alivia alergias sin causar somnolencia.','price'=>22,'stock'=>160,'image'=>$img('allergy,medicine,antihistamine,tablet',37),'discount_percentage'=>0],
                ['name'=>'Omeprazol 20mg (x14 caps)','description'=>'Inhibidor de bomba de protones para gastritis, reflujo y úlcera gástrica.','price'=>38,'stock'=>140,'image'=>$img('capsule,stomach,medicine,pharmacy',38),'discount_percentage'=>0],
                ['name'=>'Multivitamínico adulto (x30)','description'=>'Complejo vitamínico completo con 13 vitaminas y 11 minerales, fórmula de liberación prolongada.','price'=>95,'stock'=>80,'image'=>$img('multivitamin,supplement,capsule,health',39),'discount_percentage'=>5],
                ['name'=>'Crema hidratante corporal 200ml','description'=>'Crema humectante con vitamina E y colágeno, absorción rápida, piel suave en 24 horas.','price'=>45,'stock'=>70,'image'=>$img('body,cream,moisturizer,lotion',40),'discount_percentage'=>0],
                ['name'=>'Vendas elásticas (x3 unidades)','description'=>'Vendas de crepé elásticas 10cm x 4.5m, ideales para inmovilización y compresas.','price'=>35,'stock'=>90,'image'=>$img('elastic,bandage,medical,wrap',41),'discount_percentage'=>0],
                ['name'=>'Suero oral rehidratante (x6)','description'=>'Sobre de rehidratación oral con electrolitos, recupera sales minerales perdidas por diarrea.','price'=>28,'stock'=>110,'image'=>$img('oral,rehydration,sachet,electrolyte',42),'discount_percentage'=>0],
            ],
            'Farmacia Vida' => [
                ['name'=>'Mascarillas quirúrgicas (x50)','description'=>'Mascarillas desechables 3 capas con filtro de meltblown, eficiencia de filtración 98%.','price'=>45,'stock'=>200,'image'=>$img('surgical,mask,medical,protection',43),'discount_percentage'=>0],
                ['name'=>'Guantes de látex (x100)','description'=>'Guantes desechables sin polvo, textura anatómica, resistentes a perforaciones.','price'=>85,'stock'=>150,'image'=>$img('latex,gloves,medical,disposable',44),'discount_percentage'=>0],
                ['name'=>'Jeringa 5ml (x10)','description'=>'Jeringas desechables estériles con aguja 21G, para uso médico y veterinario.','price'=>18,'stock'=>120,'image'=>$img('syringe,needle,medical,sterile',45),'discount_percentage'=>0],
                ['name'=>'Protector solar SPF50+ 60ml','description'=>'Bloqueador solar de amplio espectro UVA/UVB, resistente al agua, no deja residuo blanco.','price'=>75,'stock'=>60,'image'=>$img('sunscreen,sunblock,spf,beach',46),'discount_percentage'=>0],
                ['name'=>'Shampoo medicinal anticaspa 300ml','description'=>'Shampoo con Zinc Piritionato 1%, elimina la caspa desde la primera aplicación.','price'=>55,'stock'=>80,'image'=>$img('shampoo,dandruff,hair,treatment',47),'discount_percentage'=>10],
                ['name'=>'Algodón hidrófilo 100g','description'=>'Algodón 100% natural hidrófilo, ideal para limpieza de heridas y aplicación de medicamentos.','price'=>22,'stock'=>140,'image'=>$img('cotton,roll,medical,white',48),'discount_percentage'=>0],
            ],
            'Farmacia San Jose' => [
                ['name'=>'Glucómetro digital + lancetas','description'=>'Glucómetro compacto con memoria 500 lecturas, promedio 7/14/30 días, incluye 10 tiras y lancetas.','price'=>285,'stock'=>20,'image'=>$img('glucometer,blood,sugar,diabetes',49),'discount_percentage'=>0],
                ['name'=>'Tiras reactivas glucosa (x50)','description'=>'Tiras reactivas compatibles con glucómetros estándar, resultado en 5 segundos.','price'=>165,'stock'=>45,'image'=>$img('glucose,test,strip,diabetes',50),'discount_percentage'=>0],
                ['name'=>'Calcio + Vitamina D3 (x60 tabs)','description'=>'Suplemento de calcio 600mg + vitamina D3 400UI, previene la osteoporosis y fortalece huesos.','price'=>85,'stock'=>70,'image'=>$img('calcium,vitamin,supplement,bone',51),'discount_percentage'=>0],
                ['name'=>'Omega 3 (x60 cápsulas)','description'=>'Ácidos grasos EPA y DHA de aceite de pescado premium, cuida el corazón y el cerebro.','price'=>95,'stock'=>65,'image'=>$img('omega3,fish,oil,capsule,supplement',52),'discount_percentage'=>0],
                ['name'=>'Lancetas estériles (x100)','description'=>'Lancetas 30G ultra finas para punción capilar, prácticamente indoloras.','price'=>48,'stock'=>90,'image'=>$img('lancet,diabetes,finger,prick',53),'discount_percentage'=>0],
                ['name'=>'Nebulizador compresor','description'=>'Nebulizador de pistón silencioso, para tratamiento de vías respiratorias en adultos y niños.','price'=>385,'stock'=>12,'image'=>$img('nebulizer,respiratory,medical,inhaler',54),'discount_percentage'=>8],
            ],
            'Farmacia Bienestar' => [
                ['name'=>'Colágeno hidrolizado (x30 sobres)','description'=>'Colágeno tipo I y III con vitamina C y ácido hialurónico, mejora piel, uñas y articulaciones.','price'=>145,'stock'=>50,'image'=>$img('collagen,beauty,skin,supplement',55),'discount_percentage'=>0],
                ['name'=>'Proteína Whey sabor vainilla 500g','description'=>'Proteína de suero de leche 23g por porción, bajo en grasa y carbohidratos, recuperación muscular.','price'=>185,'stock'=>30,'image'=>$img('whey,protein,powder,supplement,fitness',56),'discount_percentage'=>5],
                ['name'=>'Melatonina 3mg (x30 tabs)','description'=>'Melatonina de liberación rápida, regula el ciclo del sueño y reduce el jet lag.','price'=>65,'stock'=>80,'image'=>$img('melatonin,sleep,supplement,tablet',57),'discount_percentage'=>0],
                ['name'=>'Magnesio B6 (x30 cápsulas)','description'=>'Magnesio + vitamina B6, reduce calambres musculares, estrés y mejora la calidad del sueño.','price'=>75,'stock'=>70,'image'=>$img('magnesium,supplement,muscle,health',58),'discount_percentage'=>0],
                ['name'=>'Probióticos Lactobacillus (x15)','description'=>'Cápsulas de probióticos 10 mil millones de UFC, restaura la flora intestinal saludable.','price'=>95,'stock'=>55,'image'=>$img('probiotic,gut,health,bacteria,capsule',59),'discount_percentage'=>0],
                ['name'=>'Biotina 5000mcg (x30 caps)','description'=>'Biotina alta potencia para crecimiento del cabello, fortalecimiento de uñas y piel sana.','price'=>85,'stock'=>60,'image'=>$img('biotin,hair,nails,beauty,supplement',60),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // FERRETERÍA
            // ═══════════════════════════════════════════
            'Ferreteria El Constructor' => [
                ['name'=>'Taladro eléctrico 500W con maletin','description'=>'Taladro de percusión 500W con mango ergonómico, 13mm de capacidad y 16 posiciones de torque.','price'=>485,'stock'=>18,'image'=>$img('electric,drill,power,tool',61),'discount_percentage'=>0],
                ['name'=>'Set destornilladores (x8 piezas)','description'=>'Juego de destornilladores en acero cromo-vanadio, mangos ergonómicos anti-deslizantes.','price'=>95,'stock'=>35,'image'=>$img('screwdriver,set,tools,phillips',62),'discount_percentage'=>0],
                ['name'=>'Nivel de burbuja 60cm','description'=>'Nivel de aluminio con 3 matraces de acrílico, precisión ±0.5mm/m, ideal para albañilería.','price'=>45,'stock'=>40,'image'=>$img('spirit,level,bubble,construction',63),'discount_percentage'=>0],
                ['name'=>'Cinta métrica 5m con freno','description'=>'Metro de acero inoxidable 5m x 19mm, freno y gancho magnético, cuerpo de goma antichoque.','price'=>28,'stock'=>60,'image'=>$img('tape,measure,ruler,construction',64),'discount_percentage'=>0],
                ['name'=>'Martillo carpintero 27oz','description'=>'Martillo de acero forjado 27oz con mango de fibra de vidrio, anti-vibración certificado.','price'=>65,'stock'=>30,'image'=>$img('hammer,carpentry,tool,nail',65),'discount_percentage'=>0],
                ['name'=>'Llave stilson 12"','description'=>'Llave inglesa ajustable 12" de hierro fundido, capacidad de apertura hasta 40mm.','price'=>55,'stock'=>25,'image'=>$img('wrench,adjustable,plumbing,tool',66),'discount_percentage'=>10],
            ],
            'Ferreteria Moderna' => [
                ['name'=>'Pintura latex blanca interior 1gal','description'=>'Pintura látex 100% acrílica, alto rendimiento 12 m²/litro, lavable y de secado rápido.','price'=>85,'stock'=>40,'image'=>$img('white,paint,can,latex,wall',67),'discount_percentage'=>0],
                ['name'=>'Pintura esmalte negro brillante 1gal','description'=>'Esmalte alquídico brillante, resistente a humedad y ralladuras, secado 4-6 horas.','price'=>95,'stock'=>30,'image'=>$img('black,enamel,paint,glossy,can',68),'discount_percentage'=>0],
                ['name'=>'Rodillo de pintura 9" con charola','description'=>'Rodillo de felpa 9" con tubo de aluminio y charola plástica, aplicación uniforme y rápida.','price'=>35,'stock'=>55,'image'=>$img('paint,roller,wall,brush,painting',69),'discount_percentage'=>0],
                ['name'=>'Brocha 3" cerda natural','description'=>'Brocha profesional de cerda natural, para esmaltes y barnices, mango de madera.','price'=>25,'stock'=>70,'image'=>$img('paintbrush,bristle,natural,painting',70),'discount_percentage'=>0],
                ['name'=>'Thinner acrílico 1L','description'=>'Diluyente para pinturas acrílicas y barnices, reduce la viscosidad sin alterar el color.','price'=>38,'stock'=>50,'image'=>$img('thinner,solvent,paint,bottle',71),'discount_percentage'=>0],
                ['name'=>'Sellador madera 500ml','description'=>'Sellador de porosidades para madera cruda, base agua, seca en 30 minutos, compatible con cualquier acabado.','price'=>55,'stock'=>35,'image'=>$img('wood,sealer,varnish,timber,finish',72),'discount_percentage'=>0],
            ],
            'Todo Construccion' => [
                ['name'=>'Cemento gris 25kg','description'=>'Cemento Portland tipo I de fraguado normal, ideal para concreto, mortero y repellos.','price'=>65,'stock'=>100,'image'=>$img('cement,bag,concrete,construction',73),'discount_percentage'=>0],
                ['name'=>'Arena fina lavada 25kg','description'=>'Arena fina seleccionada y lavada, granulometría uniforme para acabados y pañetes.','price'=>35,'stock'=>120,'image'=>$img('sand,bag,construction,fine',74),'discount_percentage'=>0],
                ['name'=>'Bloque de concreto 15x20x40cm','description'=>'Bloque de concreto vibrado de alta resistencia 70 kg/cm², para muros portantes.','price'=>8,'stock'=>500,'image'=>$img('concrete,block,wall,masonry',75),'discount_percentage'=>0],
                ['name'=>'Tubo PVC presión 4" x 6m','description'=>'Tubería PVC cedula 40 para drenajes y aguas lluvias, fácil instalación con pegamento.','price'=>85,'stock'=>60,'image'=>$img('pvc,pipe,plumbing,white,tube',76),'discount_percentage'=>5],
                ['name'=>'Varilla de hierro 3/8" x 6m','description'=>'Varilla corrugada de acero grado 40, para losas, columnas y vigas de concreto armado.','price'=>48,'stock'=>80,'image'=>$img('steel,rebar,iron,bar,construction',77),'discount_percentage'=>0],
                ['name'=>'Alambre de amarre 16 (rollo 5kg)','description'=>'Alambre recocido calibre 16, rollo de 5kg, ideal para amarre de varillas de refuerzo.','price'=>55,'stock'=>45,'image'=>$img('wire,coil,steel,binding,construction',78),'discount_percentage'=>0],
            ],
            'FerreMax' => [
                ['name'=>'Amoladora angular 4.5" 850W','description'=>'Amoladora con disco 4.5", 11,000 RPM, protector ajustable, mango lateral anti-vibración.','price'=>385,'stock'=>15,'image'=>$img('angle,grinder,power,tool,metal',79),'discount_percentage'=>0],
                ['name'=>'Soldadora inversora 130A','description'=>'Soldadora inversor IGBT 130A, liviana 3.2kg, arranque en frío, electrodo 2.5-3.2mm.','price'=>850,'stock'=>8,'image'=>$img('welding,machine,electrode,arc',80),'discount_percentage'=>0],
                ['name'=>'Compresor de aire 25L 2HP','description'=>'Compresor de aire de pistón, tanque 25 litros, 115 PSI máximo, kit con manguera 5m.','price'=>1250,'stock'=>5,'image'=>$img('air,compressor,tank,industrial',81),'discount_percentage'=>10],
                ['name'=>'Discos de corte 4.5" (x25 und)','description'=>'Disco de corte abrasivo para metal y acero inoxidable, 115x1.0x22mm, alta vida útil.','price'=>85,'stock'=>50,'image'=>$img('cutting,disc,abrasive,metal,grinder',82),'discount_percentage'=>0],
                ['name'=>'Casco de seguridad ANSI','description'=>'Casco de polietileno de alta densidad con ajuste de trinquete, certificado ANSI Z89.1.','price'=>75,'stock'=>30,'image'=>$img('hard,hat,safety,helmet,construction,yellow',83),'discount_percentage'=>0],
                ['name'=>'Guantes de cuero soldador','description'=>'Guantes de cuero genuino para soldadura MIG/TIG, resistentes al calor hasta 500°C.','price'=>45,'stock'=>40,'image'=>$img('welding,gloves,leather,protection,heat',84),'discount_percentage'=>0],
            ],
            'Casa del Tornillo' => [
                ['name'=>'Tornillos madera 2" (x100)','description'=>'Tornillos para madera cabeza plana Phillips, zincado, medida 5x50mm, alta resistencia.','price'=>18,'stock'=>200,'image'=>$img('screws,wood,fasteners,box',85),'discount_percentage'=>0],
                ['name'=>'Tornillos autoperforantes 1" (x100)','description'=>'Tornillos autorroscantes para lámina y metal delgado, cabeza hex, punta broca.','price'=>15,'stock'=>200,'image'=>$img('self,tapping,screws,metal,sheet',86),'discount_percentage'=>0],
                ['name'=>'Taquetes expansores 5/16 (x50)','description'=>'Taquetes de nylon para concreto y mampostería, con tornillo incluido, carga máx 80kg.','price'=>22,'stock'=>150,'image'=>$img('wall,anchor,plug,expansion,nylon',87),'discount_percentage'=>0],
                ['name'=>'Bisagras 3" (x12 piezas)','description'=>'Bisagras de acero inoxidable 3x2.5", cromadas, carga 20kg por bisagra, para puertas.','price'=>35,'stock'=>80,'image'=>$img('door,hinge,steel,chrome,hardware',88),'discount_percentage'=>0],
                ['name'=>'Candado seguridad 50mm','description'=>'Candado de acero inoxidable con arco endurecido 50mm, resistente al corte y la corrosión.','price'=>55,'stock'=>45,'image'=>$img('padlock,security,lock,steel',89),'discount_percentage'=>0],
                ['name'=>'Cerradura interior pomo dorado','description'=>'Cerradura de pomo para puerta interior 60mm, terminado dorado, incluye 2 llaves.','price'=>145,'stock'=>25,'image'=>$img('door,lock,knob,handle,gold,hardware',90),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // JARDINERÍA
            // ═══════════════════════════════════════════
            'Jardines Verdes' => [
                ['name'=>'Manguera enrollable 25m','description'=>'Manguera de PVC reforzado con triple capa, conector de latón y pistola ajustable 7 funciones.','price'=>85,'stock'=>30,'image'=>$img('garden,hose,watering,green',91),'discount_percentage'=>0],
                ['name'=>'Regadera plástica 8L','description'=>'Regadera con boquilla desmontable de riego fino, mango ergonómico, ideal para huerto y jardín.','price'=>45,'stock'=>40,'image'=>$img('watering,can,garden,plant',92),'discount_percentage'=>0],
                ['name'=>'Pala de jardín forjada','description'=>'Pala de acero forjado con filo afilado, mango de madera de eucalipto tratado, 120cm.','price'=>55,'stock'=>25,'image'=>$img('garden,shovel,spade,digging,soil',93),'discount_percentage'=>0],
                ['name'=>'Podadora manual 20cm','description'=>'Tijera de podar de acero inoxidable con muelle de apertura, corta ramas hasta 20mm.','price'=>95,'stock'=>20,'image'=>$img('pruning,shears,garden,secateur,branch',94),'discount_percentage'=>0],
                ['name'=>'Guantes jardinería antiespin','description'=>'Guantes de algodón con recubrimiento de nitrilo en palma, protegen de espinas y cortes.','price'=>28,'stock'=>60,'image'=>$img('garden,gloves,green,protective',95),'discount_percentage'=>0],
                ['name'=>'Tierra negra orgánica 5kg','description'=>'Tierra vegetal enriquecida con humus de lombriz y compost, ph neutro, ideal para macetas.','price'=>35,'stock'=>70,'image'=>$img('potting,soil,dark,earth,organic',96),'discount_percentage'=>0],
            ],
            'Vivero Tropical' => [
                ['name'=>'Orquídea Phalaenopsis en maceta','description'=>'Hermosa orquídea mariposa en maceta de cerámica, floración prolongada 3-4 meses, fácil cuidado.','price'=>85,'stock'=>20,'image'=>$img('orchid,phalaenopsis,flower,tropical,pink',97),'discount_percentage'=>0],
                ['name'=>'Cactus surtido pequeño','description'=>'Variedad de cactus en maceta de barro 8cm, plantas decorativas de bajo mantenimiento.','price'=>25,'stock'=>50,'image'=>$img('cactus,succulent,small,pot,green',98),'discount_percentage'=>0],
                ['name'=>'Helecho Boston en maceta 20cm','description'=>'Helecho Boston exuberante, purifica el aire, ideal para interiores con luz indirecta.','price'=>55,'stock'=>18,'image'=>$img('fern,boston,green,plant,lush',99),'discount_percentage'=>0],
                ['name'=>'Rosa roja en maceta','description'=>'Rosal miniatura en maceta de cerámica, variedad de larga floración, aroma intenso.','price'=>45,'stock'=>25,'image'=>$img('rose,red,flower,pot,bloom',100),'discount_percentage'=>0],
                ['name'=>'Suculentas surtidas (x6 en cajita)','description'=>'Set 6 suculentas en cajita de madera, variedades únicas, decoración perfecta para escritorio.','price'=>65,'stock'=>15,'image'=>$img('succulents,variety,plant,pot,arrangement',101),'discount_percentage'=>10],
                ['name'=>'Bambú de la suerte en florero','description'=>'Dracaena bambú 30cm en florero de vidrio, símbolo de prosperidad, ideal como regalo.','price'=>38,'stock'=>30,'image'=>$img('bamboo,lucky,plant,vase,green',102),'discount_percentage'=>0],
            ],
            'Eco Jardin' => [
                ['name'=>'Fertilizante orgánico granulado 1kg','description'=>'Fertilizante NPK orgánico de liberación lenta, enriquece el suelo y estimula el crecimiento.','price'=>45,'stock'=>60,'image'=>$img('fertilizer,organic,granule,garden,soil',103),'discount_percentage'=>0],
                ['name'=>'Insecticida natural neem 500ml','description'=>'Insecticida a base de aceite de neem, controla plagas sin dañar insectos benéficos ni humanos.','price'=>55,'stock'=>40,'image'=>$img('neem,oil,spray,organic,plant',104),'discount_percentage'=>0],
                ['name'=>'Fungicida cobre preventivo 250ml','description'=>'Fungicida cúprico preventivo y curativo para hongos, aplicar cada 15 días en época de lluvia.','price'=>48,'stock'=>35,'image'=>$img('fungicide,spray,copper,plant,disease',105),'discount_percentage'=>0],
                ['name'=>'Turba musgo perlada 10L','description'=>'Turba de musgo sphagnum perlada, retiene la humedad y mejora la aireación de las raíces.','price'=>65,'stock'=>45,'image'=>$img('peat,moss,sphagnum,substrate,garden',106),'discount_percentage'=>0],
                ['name'=>'Perlita hortícola 5L','description'=>'Perlita de grado hortícola para mezclas de sustrato, mejora el drenaje y evita el apelmazamiento.','price'=>35,'stock'=>55,'image'=>$img('perlite,white,substrate,horticulture,bag',107),'discount_percentage'=>0],
                ['name'=>'Lombricompost 5kg','description'=>'Humus de lombriz rojo californiano, el fertilizante orgánico más completo, rico en microorganismos.','price'=>55,'stock'=>50,'image'=>$img('worm,compost,organic,humus,soil',108),'discount_percentage'=>0],
            ],
            'Naturaleza Viva' => [
                ['name'=>'Maceta de terracota 20cm','description'=>'Maceta artesanal de barro cocido 20cm, ideal para plantas de interior y exterior, permite transpiración.','price'=>35,'stock'=>50,'image'=>$img('terracotta,pot,clay,plant,garden',109),'discount_percentage'=>0],
                ['name'=>'Maceta plástico 30cm con plato','description'=>'Maceta plástica UV resistente 30cm con plato recolector, variedad de colores disponibles.','price'=>25,'stock'=>70,'image'=>$img('plastic,pot,colorful,plant,round',110),'discount_percentage'=>0],
                ['name'=>'Maceta colgante fibra natural','description'=>'Maceta colgante trenzada de fibra natural, con liner de coco, para plantas colgantes y helechos.','price'=>28,'stock'=>40,'image'=>$img('hanging,basket,planter,macrame,plant',111),'discount_percentage'=>0],
                ['name'=>'Jardinera rectangular 60cm','description'=>'Jardinera de madera tratada 60x20x18cm para balcones y ventanas, con orificios de drenaje.','price'=>85,'stock'=>20,'image'=>$img('window,box,planter,wood,balcony',112),'discount_percentage'=>0],
                ['name'=>'Piedras decorativas blancas 1kg','description'=>'Piedras de mármol blanco natural para decoración de macetas y jardines, lavadas y pulidas.','price'=>18,'stock'=>100,'image'=>$img('decorative,pebbles,white,stones,garden',113),'discount_percentage'=>0],
                ['name'=>'Sustrato universal premium 5L','description'=>'Sustrato de alta calidad con corteza de pino, perlita y compost, ph 5.5-6.5, óptimo para flores.','price'=>38,'stock'=>60,'image'=>$img('potting,mix,substrate,bag,plant,soil',114),'discount_percentage'=>0],
            ],
            'Green House' => [
                ['name'=>'Semillas de tomate cherry (sobre)','description'=>'Semillas de tomate cherry híbrido, alta producción, resistente a enfermedades, ciclo 70 días.','price'=>12,'stock'=>150,'image'=>$img('tomato,seeds,cherry,vegetable,packet',115),'discount_percentage'=>0],
                ['name'=>'Semillas de chile pimiento (sobre)','description'=>'Semillas de pimiento morrón tricolor, alto rendimiento, frutos grandes y carnosos.','price'=>12,'stock'=>130,'image'=>$img('pepper,bell,seeds,vegetable,packet',116),'discount_percentage'=>0],
                ['name'=>'Semillas de lechuga mixta (sobre)','description'=>'Mix de semillas de lechuga romana, crespa y roble, ideal para huertos urbanos y ensaladas.','price'=>10,'stock'=>140,'image'=>$img('lettuce,seeds,salad,green,vegetable',117),'discount_percentage'=>0],
                ['name'=>'Kit huerto urbano completo','description'=>'Kit todo incluido: 6 macetas, sustrato, 8 sobres de semillas, herramientas mini y guía de cultivo.','price'=>185,'stock'=>15,'image'=>$img('urban,garden,kit,herbs,planter,indoor',118),'discount_percentage'=>0],
                ['name'=>'Invernadero portátil 4 estantes','description'=>'Invernadero mini de PVC y polietileno 143x73x195cm, 4 estantes, protege del viento y heladas.','price'=>285,'stock'=>8,'image'=>$img('mini,greenhouse,portable,plastic,garden',119),'discount_percentage'=>10],
                ['name'=>'Sensor humedad suelo digital','description'=>'Sensor digital de humedad del suelo con pantalla LCD, mide pH y luz, pilas incluidas.','price'=>65,'stock'=>30,'image'=>$img('soil,moisture,sensor,digital,garden,meter',120),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // PAPELERÍA
            // ═══════════════════════════════════════════
            'Papeleria Escolar Plus' => [
                ['name'=>'Resma papel A4 75g (x500 hojas)','description'=>'Papel bond blanco A4 75g/m², alta blancura 92%, compatible con todas las impresoras láser e inkjet.','price'=>45,'stock'=>100,'image'=>$img('paper,ream,white,a4,office',121),'discount_percentage'=>0],
                ['name'=>'Cuaderno universitario 100 hojas','description'=>'Cuaderno universitario de 100 hojas rayadas, espiral doble, pasta dura plastificada.','price'=>18,'stock'=>150,'image'=>$img('notebook,spiral,school,ruled,lined',122),'discount_percentage'=>0],
                ['name'=>'Lapiceros BIC cristal (x12)','description'=>'Caja 12 lapiceros BIC cristal punta fina 0.8mm, tinta de larga duración, surtido colores.','price'=>15,'stock'=>200,'image'=>$img('ballpoint,pen,bic,blue,writing',123),'discount_percentage'=>0],
                ['name'=>'Lápices de colores Crayola x24','description'=>'Set 24 lápices de colores pre-afilados, colores vivos y resistentes a la rotura.','price'=>28,'stock'=>80,'image'=>$img('colored,pencils,crayola,art,rainbow',124),'discount_percentage'=>0],
                ['name'=>'Mochila escolar 18" resistente','description'=>'Mochila de poliéster 600D con 3 compartimentos, porta laptop 15", acolchada en espalda.','price'=>185,'stock'=>25,'image'=>$img('school,backpack,bag,student,colorful',125),'discount_percentage'=>0],
                ['name'=>'Tijeras escolares punta redonda','description'=>'Tijeras de acero inoxidable 17cm con mango plástico ergonómico, seguras para niños.','price'=>12,'stock'=>100,'image'=>$img('scissors,craft,school,cut,stationery',126),'discount_percentage'=>0],
            ],
            'Mundo Escolar' => [
                ['name'=>'Plumones Crayola washable (x10)','description'=>'Marcadores lavables de punta gruesa, colores brillantes que se lavan de piel y tela.','price'=>45,'stock'=>80,'image'=>$img('marker,washable,colorful,drawing,crayola',127),'discount_percentage'=>0],
                ['name'=>'Crayones cera (x24 colores)','description'=>'Crayones de cera suave con alta pigmentación, no tóxicos, certificado ASTM D-4236.','price'=>22,'stock'=>90,'image'=>$img('crayons,wax,colorful,kids,drawing',128),'discount_percentage'=>0],
                ['name'=>'Acuarelas 12 colores Prang','description'=>'Set de acuarelas semisólidas con pincel incluido, colores transparentes y luminosos.','price'=>35,'stock'=>60,'image'=>$img('watercolor,paint,palette,brush,art',129),'discount_percentage'=>0],
                ['name'=>'Pintura tempera (x6 frascos 60ml)','description'=>'Temperas lavables de alta pigmentación, secado rápido, colores básicos para manualidades.','price'=>48,'stock'=>55,'image'=>$img('tempera,paint,bottle,colorful,kids',130),'discount_percentage'=>10],
                ['name'=>'Cartulina 50x70cm (x10 hojas)','description'=>'Cartulina de colores surtidos 230g/m², ideal para manualidades, carteles y proyectos escolares.','price'=>28,'stock'=>70,'image'=>$img('cardboard,colorful,sheet,craft,art',131),'discount_percentage'=>0],
                ['name'=>'Foam board blanco 70x100cm','description'=>'Placa de espuma de poliestireno laminada con papel blanco, 5mm de grosor, para maquetas.','price'=>22,'stock'=>45,'image'=>$img('foam,board,white,model,presentation',132),'discount_percentage'=>0],
            ],
            'Office Center' => [
                ['name'=>'Archivador lomo 7.5cm A-Z','description'=>'Archivador de cartón forrado en tela, lomo 7.5cm, palanca metálica y guía alfa en lomo.','price'=>28,'stock'=>60,'image'=>$img('binder,folder,office,archive,document',133),'discount_percentage'=>0],
                ['name'=>'Grapadora metálica 26/6','description'=>'Grapadora de acero 20 hojas capacidad, usa grapas 26/6, incluye 1000 grapas.','price'=>45,'stock'=>40,'image'=>$img('stapler,metal,office,desk,staples',134),'discount_percentage'=>0],
                ['name'=>'Perforadora 2 hoyos 20 hojas','description'=>'Perforadora de metal con bandeja recolectora, 2 hoyos 5.5mm, capacidad 20 hojas.','price'=>38,'stock'=>35,'image'=>$img('hole,punch,office,paper,perforator',135),'discount_percentage'=>0],
                ['name'=>'Post-it 3x3" (x3 blocks 100h)','description'=>'Notas adhesivas 3M originales, reposicionables sin dejar residuo, pack 3 colores neón.','price'=>28,'stock'=>80,'image'=>$img('sticky,notes,post,colorful,neon,office',136),'discount_percentage'=>0],
                ['name'=>'Calculadora científica fx-82','description'=>'Calculadora científica 252 funciones, pantalla LCD natural, ideal para bachillerato y universidad.','price'=>95,'stock'=>20,'image'=>$img('calculator,scientific,casio,math,school',137),'discount_percentage'=>0],
                ['name'=>'Carpetas transparentes (x10)','description'=>'Carpetas de polipropileno L transparentes, 160 micras, para documentos A4 sin perforar.','price'=>18,'stock'=>100,'image'=>$img('transparent,folder,plastic,document,office',138),'discount_percentage'=>0],
            ],
            'Papeleria Creativa' => [
                ['name'=>'Set scrapbook completo','description'=>'Kit scrapbooking con álbum 30x30, 100 papeles decorados, stickers, cintas y herramientas.','price'=>85,'stock'=>15,'image'=>$img('scrapbook,craft,creative,album,art',139),'discount_percentage'=>0],
                ['name'=>'Papel origami (x100 hojas 15x15)','description'=>'Papel de origami 15x15cm, 100 hojas en 20 colores y patrones, 70g/m², doblado perfecto.','price'=>25,'stock'=>50,'image'=>$img('origami,paper,folding,colorful,japanese',140),'discount_percentage'=>0],
                ['name'=>'Cintas washi decorativas (x5 rollos)','description'=>'Set 5 cintas washi de papel de arroz con diseños florales y geométricos, ancho 15mm.','price'=>38,'stock'=>45,'image'=>$img('washi,tape,decorative,roll,pattern',141),'discount_percentage'=>0],
                ['name'=>'Stickers decorativos (x200 piezas)','description'=>'Pack 200 stickers en papel holográfico, vintage y kawaii para bullet journal y decoración.','price'=>18,'stock'=>80,'image'=>$img('stickers,holographic,decorative,kawaii,art',142),'discount_percentage'=>0],
                ['name'=>'Marcadores artísticos doble punta x20','description'=>'Set 20 marcadores con punta fina y punta pincel, tinta a base de agua, para lettering y arte.','price'=>95,'stock'=>25,'image'=>$img('art,markers,brush,pen,lettering,set',143),'discount_percentage'=>5],
                ['name'=>'Lienzo canvas 30x40cm','description'=>'Lienzo de algodón 100% tensado sobre bastidor de madera, 280g/m², imprimado doble capa.','price'=>45,'stock'=>30,'image'=>$img('canvas,painting,art,white,easel',144),'discount_percentage'=>0],
            ],
            'Lapiz y Papel' => [
                ['name'=>'Agenda ejecutiva 2026 semana-vista','description'=>'Agenda semanal tapa dura polipiel, semanal+notas, cinta marcadora, bolsillo interior.','price'=>55,'stock'=>30,'image'=>$img('planner,agenda,diary,notebook,weekly',145),'discount_percentage'=>0],
                ['name'=>'Notas adhesivas neón (x4 bloques)','description'=>'Pack 4 blocks 75x75mm en colores neón 80h c/u, adhesivo reposicionable de alta calidad.','price'=>22,'stock'=>60,'image'=>$img('sticky,notes,neon,fluorescent,post',146),'discount_percentage'=>0],
                ['name'=>'Regla 30cm metálica con corcho','description'=>'Regla de aluminio 30cm con base antideslizante de corcho, escala milimétrica grabada.','price'=>15,'stock'=>80,'image'=>$img('ruler,metal,aluminum,measurement,30cm',147),'discount_percentage'=>0],
                ['name'=>'Compás geométrico profesional','description'=>'Compás de metal ajustable con adaptador de lápiz y portaminas, estuche incluido.','price'=>25,'stock'=>45,'image'=>$img('compass,geometry,drawing,circle,math',148),'discount_percentage'=>0],
                ['name'=>'Borrador blanco premium (x3)','description'=>'Pack 3 borradores de PVC libre de ftalatos, no mancha, borra limpiamente sin dañar el papel.','price'=>8,'stock'=>150,'image'=>$img('eraser,white,school,pencil,clean',149),'discount_percentage'=>0],
                ['name'=>'Corrector líquido punta metal','description'=>'Corrector líquido de secado ultra rápido con punta de metal, no amarilla con el tiempo.','price'=>12,'stock'=>120,'image'=>$img('correction,fluid,white,liquid,pen,office',150),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // TECNOLOGÍA
            // ═══════════════════════════════════════════
            'Tecno Store' => [
                ['name'=>'Mouse inalámbrico ergonómico','description'=>'Mouse inalámbrico 2.4GHz, 1600 DPI ajustable, receptor nano USB, 18 meses de batería.','price'=>145,'stock'=>35,'image'=>$img('wireless,mouse,computer,ergonomic,optical',151),'discount_percentage'=>0],
                ['name'=>'Teclado mecánico TKL RGB USB','description'=>'Teclado mecánico 87 teclas switches blue, retroiluminación RGB 16M colores, antighoster N-key.','price'=>285,'stock'=>18,'image'=>$img('mechanical,keyboard,rgb,computer,backlit',152),'discount_percentage'=>0],
                ['name'=>'Monitor LED 21.5" Full HD IPS','description'=>'Monitor IPS Full HD 1080p, 75Hz, 5ms, HDMI+VGA, antireflejo, ajuste de altura, 3 años garantía.','price'=>1450,'stock'=>8,'image'=>$img('computer,monitor,led,screen,display',153),'discount_percentage'=>5],
                ['name'=>'Memoria USB 32GB 3.0','description'=>'Memoria USB 3.0 con velocidad de lectura 80MB/s, carcasa de aluminio, compatible Windows/Mac.','price'=>45,'stock'=>60,'image'=>$img('usb,flash,drive,memory,stick,storage',154),'discount_percentage'=>0],
                ['name'=>'Hub USB 4 puertos 3.0','description'=>'Concentrador USB 3.0 con 4 puertos y LED indicador, cable 60cm, transferencia 5Gbps.','price'=>85,'stock'=>30,'image'=>$img('usb,hub,ports,adapter,computer',155),'discount_percentage'=>0],
                ['name'=>'Pad mouse XL 80x30cm','description'=>'Mousepad extra grande con base antideslizante de goma, superficie textil de alta precisión.','price'=>55,'stock'=>40,'image'=>$img('mousepad,desk,computer,gaming,large',156),'discount_percentage'=>0],
            ],
            'Digital World' => [
                ['name'=>'Audífonos Bluetooth 5.0 ANC','description'=>'Auriculares over-ear con cancelación activa de ruido, 30h batería, plegables, carga USB-C.','price'=>185,'stock'=>20,'image'=>$img('bluetooth,headphones,wireless,music,anc',157),'discount_percentage'=>10],
                ['name'=>'Cargador rápido 20W GaN USB-C','description'=>'Cargador GaN 20W con tecnología de carga rápida PD 3.0, compacto, compatible con iPhone y Android.','price'=>65,'stock'=>50,'image'=>$img('fast,charger,usb,adapter,compact',158),'discount_percentage'=>0],
                ['name'=>'Cable USB-C trenzado 1m','description'=>'Cable USB-C trenzado de nylon, carga 60W y datos USB 3.1, compatible con todos los dispositivos.','price'=>25,'stock'=>80,'image'=>$img('usb,cable,braided,nylon,charging',159),'discount_percentage'=>0],
                ['name'=>'Funda celular silicona universal','description'=>'Funda de silicona líquida con borde airbag, compatible con iPhones y Samsungs modernos.','price'=>28,'stock'=>60,'image'=>$img('phone,case,silicon,cover,protection',160),'discount_percentage'=>0],
                ['name'=>'Vidrio templado 9H universal','description'=>'Protector de pantalla vidrio templado 9H anti-rayones, compatible con la mayoría de smartphones.','price'=>15,'stock'=>100,'image'=>$img('screen,protector,tempered,glass,phone',161),'discount_percentage'=>0],
                ['name'=>'Power bank 10000mAh USB-C','description'=>'Banco de energía 10000mAh con carga rápida 18W, 2 USB-A + USB-C, pantalla LED porcentaje.','price'=>185,'stock'=>22,'image'=>$img('power,bank,portable,charger,battery',162),'discount_percentage'=>0],
            ],
            'CompuCenter' => [
                ['name'=>'RAM DDR4 8GB 3200MHz','description'=>'Memoria RAM DDR4 8GB 3200MHz CL16, single rank, compatible con Intel y AMD, perfil bajo.','price'=>485,'stock'=>12,'image'=>$img('ram,memory,ddr4,computer,hardware,stick',163),'discount_percentage'=>0],
                ['name'=>'SSD 240GB SATA III 2.5"','description'=>'Disco de estado sólido 240GB SATA III, 500MB/s lectura, instalación inmediata, garantía 3 años.','price'=>385,'stock'=>10,'image'=>$img('ssd,solid,state,drive,storage,computer',164),'discount_percentage'=>0],
                ['name'=>'Procesador Intel Core i3-12100','description'=>'Procesador de 12ª gen 4 núcleos 8 hilos, 3.3-4.3GHz, LGA1700, con cooler incluido, 12MB cache.','price'=>1650,'stock'=>5,'image'=>$img('cpu,processor,intel,chip,computer,lga',165),'discount_percentage'=>0],
                ['name'=>'Pasta térmica Thermal Grizzly 5g','description'=>'Pasta conductora de calor 12.5W/mK para CPU y GPU, aplicación sencilla con paleta incluida.','price'=>25,'stock'=>40,'image'=>$img('thermal,paste,cpu,cooling,compound',166),'discount_percentage'=>0],
                ['name'=>'Ventilador 120mm PWM ARGB','description'=>'Fan 120mm con control PWM y LED ARGB sincronizable, 500-1800RPM, conector 4 pines.','price'=>95,'stock'=>20,'image'=>$img('computer,fan,120mm,rgb,case,cooling',167),'discount_percentage'=>0],
                ['name'=>'Disco duro 1TB 7200rpm 3.5"','description'=>'HDD 1TB SATA 7200RPM, caché 64MB, para PC de escritorio, almacenamiento masivo económico.','price'=>485,'stock'=>10,'image'=>$img('hard,drive,hdd,1tb,storage,disk',168),'discount_percentage'=>0],
            ],
            'Tech Solutions' => [
                ['name'=>'Router WiFi 6 AX1800 dual band','description'=>'Router inalámbrico WiFi 6, 1800Mbps, bandas 2.4+5GHz, MU-MIMO, OFDMA, 4 antenas externas.','price'=>485,'stock'=>10,'image'=>$img('wifi,router,network,wireless,antenna',169),'discount_percentage'=>0],
                ['name'=>'Switch 8 puertos Gigabit','description'=>'Switch no administrado 8 puertos Gigabit 10/100/1000Mbps, plug and play, carcasa metálica.','price'=>185,'stock'=>15,'image'=>$img('network,switch,ethernet,gigabit,ports',170),'discount_percentage'=>0],
                ['name'=>'Cable UTP Cat6 (rollo 30m)','description'=>'Cable de red Cat6 FTP 30 metros, transferencia hasta 10Gbps, núcleo de cobre sólido.','price'=>145,'stock'=>20,'image'=>$img('ethernet,cable,cat6,network,rj45,roll',171),'discount_percentage'=>0],
                ['name'=>'Conectores RJ45 Cat6 (x50)','description'=>'Conectores RJ45 de 8 posiciones para cable Cat5e/Cat6, cristal transparente, engaste sencillo.','price'=>25,'stock'=>80,'image'=>$img('rj45,connector,network,cable,plug,ethernet',172),'discount_percentage'=>0],
                ['name'=>'Adaptador HDMI a VGA con audio','description'=>'Convertidor activo HDMI macho a VGA hembra Full HD 1080p con salida de audio 3.5mm.','price'=>65,'stock'=>30,'image'=>$img('hdmi,vga,adapter,converter,cable,video',173),'discount_percentage'=>0],
                ['name'=>'Webcam HD 1080p con micrófono','description'=>'Cámara web Full HD 30fps con micrófono integrado con cancelación de ruido, plug and play.','price'=>185,'stock'=>15,'image'=>$img('webcam,camera,usb,1080p,video,conference',174),'discount_percentage'=>0],
            ],
            'Smart Electronics' => [
                ['name'=>'Bocina Bluetooth portátil IPX7','description'=>'Bocina waterproof IPX7, 360° sonido, 24h batería, NFC pairing, mosquetón para aventuras.','price'=>185,'stock'=>18,'image'=>$img('bluetooth,speaker,portable,music,waterproof',175),'discount_percentage'=>0],
                ['name'=>'Smartwatch deportivo GPS','description'=>'Reloj inteligente con GPS integrado, monitor cardíaco 24/7, SpO2, 5ATM, 7 días batería.','price'=>385,'stock'=>10,'image'=>$img('smartwatch,fitness,tracker,gps,sport',176),'discount_percentage'=>0],
                ['name'=>'Auriculares TWS in-ear ANC','description'=>'Earbuds true wireless con ANC, 8h+24h estuche, Bluetooth 5.2, resistentes al agua IPX4.','price'=>145,'stock'=>22,'image'=>$img('tws,earbuds,wireless,earphone,bluetooth,anc',177),'discount_percentage'=>10],
                ['name'=>'Lámpara LED escritorio regulable','description'=>'Lámpara de escritorio LED 10W con 5 modos de color, 10 niveles de brillo, puerto USB carga.','price'=>95,'stock'=>25,'image'=>$img('led,desk,lamp,light,study,office',178),'discount_percentage'=>0],
                ['name'=>'Cámara IP WiFi 1080p exterior','description'=>'Cámara de seguridad WiFi Full HD, visión nocturna 30m, detección de movimiento, app móvil.','price'=>285,'stock'=>12,'image'=>$img('security,camera,ip,wifi,cctv,outdoor',179),'discount_percentage'=>0],
                ['name'=>'Control remoto universal smart','description'=>'Control universal compatible con 8000+ marcas de TV, aire acondicionado y streaming boxes.','price'=>45,'stock'=>40,'image'=>$img('remote,control,universal,tv,smart,infrared',180),'discount_percentage'=>0],
            ],

            // ═══════════════════════════════════════════
            // VIDEOJUEGOS
            // ═══════════════════════════════════════════
            'Gamer Zone' => [
                ['name'=>'Control PS5 DualSense blanco','description'=>'Control oficial Sony PS5 con háptica avanzada, gatillos adaptables y micrófono integrado.','price'=>585,'stock'=>12,'image'=>$img('playstation,ps5,controller,dualsense,gamepad',181),'discount_percentage'=>0],
                ['name'=>'Control Xbox Series X negro','description'=>'Control oficial Microsoft Series X/S con botón share, texturas mejoradas y batería recargable.','price'=>485,'stock'=>10,'image'=>$img('xbox,controller,series,gamepad,gaming',182),'discount_percentage'=>0],
                ['name'=>'Headset gaming RGB 7.1 surround','description'=>'Auriculares gaming con sonido 7.1 virtual, RGB ajustable, micrófono flexible, USB+3.5mm.','price'=>285,'stock'=>15,'image'=>$img('gaming,headset,headphones,rgb,microphone',183),'discount_percentage'=>0],
                ['name'=>'Mousepad gaming XL 80x40cm','description'=>'Alfombra gamer extra grande con bordado antideshilachado, base antideslizante gruesa.','price'=>85,'stock'=>30,'image'=>$img('mousepad,gaming,xl,desk,large,mat',184),'discount_percentage'=>0],
                ['name'=>'Juego FIFA 25 para PS5','description'=>'FIFA 25 edición estándar para PlayStation 5, modo carrera mejorado y Ultimate Team.','price'=>385,'stock'=>20,'image'=>$img('football,soccer,game,ps5,sports,videogame',185),'discount_percentage'=>0],
                ['name'=>'Tarjeta PSN $20 USD','description'=>'Tarjeta prepago PlayStation Network $20, para comprar juegos, DLC y PS Plus en cualquier cuenta.','price'=>185,'stock'=>50,'image'=>$img('playstation,gift,card,psn,digital,gaming',186),'discount_percentage'=>0],
            ],
            'Play Center' => [
                ['name'=>'Nintendo Switch OLED blanca','description'=>'Consola Nintendo Switch OLED 7" con dock, 2 Joy-Con, 64GB internos y salida HDMI.','price'=>2850,'stock'=>6,'image'=>$img('nintendo,switch,oled,console,gaming,portable',187),'discount_percentage'=>0],
                ['name'=>'Mario Kart 8 Deluxe Switch','description'=>'Juego de carreras más vendido de Nintendo, 48 circuitos, hasta 12 jugadores online.','price'=>385,'stock'=>14,'image'=>$img('mario,kart,nintendo,racing,game,switch',188),'discount_percentage'=>0],
                ['name'=>'Zelda Breath of the Wild Switch','description'=>'La aventura de Link en el mundo abierto de Hyrule, ganador de más de 250 premios GOTY.','price'=>385,'stock'=>12,'image'=>$img('zelda,link,adventure,game,nintendo,rpg',189),'discount_percentage'=>0],
                ['name'=>'MicroSD Samsung Evo 128GB','description'=>'Tarjeta microSDXC 128GB clase 10 U3, velocidad 100MB/s lectura, compatible Switch y cámaras.','price'=>185,'stock'=>25,'image'=>$img('microsd,memory,card,128gb,storage,samsung',190),'discount_percentage'=>0],
                ['name'=>'Funda Switch premium viaje','description'=>'Estuche EVA semirígido para Nintendo Switch con compartimientos para juegos y accesorios.','price'=>65,'stock'=>20,'image'=>$img('nintendo,switch,case,travel,protection,bag',191),'discount_percentage'=>0],
                ['name'=>'Estación carga 4 Joy-Con','description'=>'Base de carga simultánea para 4 Joy-Con con LEDs indicadores, conexión USB-C.','price'=>85,'stock'=>15,'image'=>$img('joycon,charger,nintendo,dock,station',192),'discount_percentage'=>0],
            ],
            'Next Level Gaming' => [
                ['name'=>'Silla gamer ergonómica racing','description'=>'Silla gamer con reposacabezas y lumbar ajustables, reclinación 135°, pistón clase 4, ruedas 60mm.','price'=>1850,'stock'=>5,'image'=>$img('gaming,chair,ergonomic,racing,seat,rgb',193),'discount_percentage'=>0],
                ['name'=>'Monitor gaming 24" 144Hz IPS','description'=>'Monitor IPS 24" Full HD 144Hz, 1ms, G-Sync compatible, HDR400, 2x HDMI + DisplayPort.','price'=>1650,'stock'=>6,'image'=>$img('gaming,monitor,144hz,display,screen,setup',194),'discount_percentage'=>5],
                ['name'=>'Teclado gaming TKL RGB hot-swap','description'=>'Teclado 87 teclas hot-swap, switches red lineales, RGB por tecla, aluminio con volumen dedicado.','price'=>385,'stock'=>10,'image'=>$img('gaming,keyboard,rgb,mechanical,tkl,hotswap',195),'discount_percentage'=>0],
                ['name'=>'Mouse gaming 16000 DPI RGB','description'=>'Ratón gaming con sensor óptico 16K DPI, 7 botones programables, RGB 16M colores, 80g.','price'=>285,'stock'=>12,'image'=>$img('gaming,mouse,rgb,optical,dpi,gamer',196),'discount_percentage'=>0],
                ['name'=>'Auriculares 7.1 Surround USB','description'=>'Headset gaming USB con sonido envolvente 7.1, drivers 50mm, micrófono retráctil, diadema acolchada.','price'=>385,'stock'=>8,'image'=>$img('gaming,headset,7.1,surround,sound,usb',197),'discount_percentage'=>0],
                ['name'=>'Capturadora HDMI 4K USB 3.0','description'=>'Capturadora de video HDMI 4K/30fps, grabación en 1080p/60fps, compatible OBS, sin drivers.','price'=>485,'stock'=>7,'image'=>$img('capture,card,hdmi,streaming,obs,usb',198),'discount_percentage'=>0],
            ],
            'Retro Games' => [
                ['name'=>'Super Nintendo Classic Mini','description'=>'Consola retro oficial con 21 juegos preinstalados: Mario, Zelda, Street Fighter y más.','price'=>485,'stock'=>8,'image'=>$img('super,nintendo,snes,retro,console,classic',199),'discount_percentage'=>0],
                ['name'=>'PlayStation Classic Mini','description'=>'Consola retro Sony con 20 juegos clásicos PS1, incluye 2 controles DualShock originales.','price'=>485,'stock'=>6,'image'=>$img('playstation,classic,retro,ps1,console,sony',200),'discount_percentage'=>0],
                ['name'=>'Game Boy Color + juego incluido','description'=>'Game Boy Color original refaccionado con batería nueva, incluye juego Pokémon original.','price'=>385,'stock'=>4,'image'=>$img('gameboy,color,retro,handheld,nintendo,pokemon',201),'discount_percentage'=>0],
                ['name'=>'Joystick arcade USB 2 jugadores','description'=>'Palanca arcade de madera con botones Sanwa, conexión USB, compatible PC, Mac y Raspberry Pi.','price'=>145,'stock'=>10,'image'=>$img('arcade,joystick,stick,retro,game,button',202),'discount_percentage'=>0],
                ['name'=>'Consola retro portátil 30000 juegos','description'=>'Emulador portátil con 30,000 juegos clásicos pre-cargados, pantalla 3.5" IPS, batería 3000mAh.','price'=>285,'stock'=>12,'image'=>$img('retro,handheld,console,emulator,portable,game',203),'discount_percentage'=>10],
                ['name'=>'Control NES USB (x2 unidades)','description'=>'Par de controles USB réplica exacta del NES original, compatible PC, Mac, Android y Raspberry Pi.','price'=>85,'stock'=>20,'image'=>$img('nes,controller,retro,usb,gamepad,classic',204),'discount_percentage'=>0],
            ],
            'Game Planet' => [
                ['name'=>'Xbox Game Pass Ultimate 3 meses','description'=>'Suscripción Xbox Game Pass Ultimate 3 meses, más de 100 juegos en consola, PC y cloud gaming.','price'=>185,'stock'=>30,'image'=>$img('xbox,game,pass,subscription,cloud,gaming',205),'discount_percentage'=>0],
                ['name'=>'Tarjeta Nintendo eShop $15 USD','description'=>'Código digital Nintendo eShop $15, para descargar juegos, DLC y suscripciones Switch Online.','price'=>145,'stock'=>40,'image'=>$img('nintendo,eshop,gift,card,digital,switch',206),'discount_percentage'=>0],
                ['name'=>'Auriculares gaming PC USB','description'=>'Headset estéreo USB con drivers 40mm, micrófono omnidireccional con mute, diadema ajustable.','price'=>185,'stock'=>15,'image'=>$img('gaming,headset,pc,usb,microphone,stereo',207),'discount_percentage'=>0],
                ['name'=>'Alfombra gaming XXL 120x60cm','description'=>'Mousepad extra grande cosido en bordes, superficie control/velocidad, base goma antideslizante.','price'=>145,'stock'=>18,'image'=>$img('gaming,desk,mat,xxl,mousepad,setup',208),'discount_percentage'=>0],
                ['name'=>'Soporte vertical PS5 con cargador','description'=>'Stand vertical para PS5 con base de carga para 2 controles DualSense, LED indicador.','price'=>65,'stock'=>12,'image'=>$img('ps5,stand,dock,vertical,charger,playstation',209),'discount_percentage'=>0],
                ['name'=>'Kit limpieza consolas 6 en 1','description'=>'Set de limpieza para consolas con brocha anti-estática, paños microfibra, hisopo y spray.','price'=>45,'stock'=>25,'image'=>$img('console,cleaning,kit,brush,tool,gamer',210),'discount_percentage'=>0],
            ],
        ];

        // Eliminar productos existentes de los 35 comercios antes de re-insertar
        $commerceNames = array_keys($catalog);
        $commerceIds   = Commerce::whereIn('name', $commerceNames)->pluck('id');
        DB::table('products')->whereIn('commerce_id', $commerceIds)->delete();
        $this->command->info('Productos anteriores eliminados.');

        foreach ($catalog as $commerceName => $products) {
            $commerce = Commerce::where('name', $commerceName)->first();
            if (! $commerce) {
                $this->command->warn("Comercio no encontrado: {$commerceName}");
                continue;
            }

            $rows = array_map(fn($p) => array_merge($p, [
                'commerce_id' => $commerce->id,
                'status'      => 'activo',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]), $products);

            DB::table('products')->insert($rows);
            $this->command->info("✓ {$commerceName} — " . count($rows) . ' productos');
        }

        $total = DB::table('products')->count();
        $this->command->info("Total productos en BD: {$total}");
    }
}
