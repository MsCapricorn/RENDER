# Dataset para expansión UTC

Fecha de consulta y compilación: **6 de octubre de 2026**.

La entrega reúne datos públicos verificables para evaluar Cuajimalpa y el entorno de Chamapa–Lechería. Es una base de investigación y comparación territorial. No determina todavía una ubicación rentable ni estima alumnos captables.

## Cobertura y contenido

Se incluyen **toda la CDMX (16 alcaldías) y todo el Estado de México (125 municipios): 141 territorios**. El campo `alcance` distingue «Zonas solicitadas» (Cuajimalpa, Naucalpan, Atizapán e Izcalli), «Entorno original» (Álvaro Obregón, Huixquilucan, Nicolás Romero, Tlalnepantla y Tultitlán) y «Alternativas regionales» (los otros 132). `es_zona_solicitada` es un filtro administrativo: no equivale al polígono exacto del corredor ni a las colonias objetivo de Cuajimalpa. Las tablas municipales incluyen población urbana y rural; las manzanas y AGEB de este producto son urbanas.

| Capa | Registros | Fecha / unidad |
|---|---:|---|
| Manzanas urbanas | 203,363 | Censo 2020 |
| Demografía AGEB | 6,898 | Censo 2020 |
| Establecimientos DENUE | 1,283,585 | Mayo 2026 |
| Registros educativos DENUE | 30,639 | Establecimiento, varios niveles |
| Inventario feeder y escuelas de niveles mixtos | 6,879 | No incluye matrícula por plantel |
| Programas de educación superior | 25,962 | 12,669 de 2024–25 y 13,293 de 2025–26 |
| Campus agregados del ciclo más reciente | 1,328 | Registros institución/campus/municipio; validar sedes físicas |
| Indicadores municipales de pobreza | 6,768 | CONEVAL 2010, 2015 y 2020 |

El Excel contiene comparación municipal completa, actualización2025, campus agregados, pobreza y controles. El detalle completo de AGEB, escuelas, programas, establecimientos y manzanas se consulta en los CSV del ZIP. El ZIP incluye las tablas completas en CSV UTF-8, polígonos GeoJSON, fuentes, controles, diccionarios y scripts de integración. Los CSV preservan claves como texto; al importarlos, impedir que Excel o Power BI eliminen ceros iniciales.

## Qué aporta la investigación

Se incorporó la Encuesta Intercensal 2025, publicada en septiembre de 2026, para actualizar la comparación municipal. Se conservaron sus estimadores y sus diccionarios. No se repartió población de 2025 entre AGEB de 2020 mediante proporciones inventadas.

| Territorio núcleo | Población censal 2020 | Estimación 2025 | CV de estimación 2025 (%) |
|---|---:|---:|---:|
| Cuajimalpa | 217,686 | 224,262 | 19.99 |
| Naucalpan | 834,434 | 839,763 | 8.12 |
| Atizapán | 523,674 | 529,718 | 6.08 |
| Cuautitlán Izcalli | 555,163 | 596,334 | 12.63 |

La comparación encuesta/censo es descriptiva. En Cuajimalpa, el intervalo publicado para la población 2025 es aproximadamente 149,980–298,544: la diferencia puntual frente a 2020 no demuestra crecimiento. Consultar los intervalos y CV antes de interpretar cambios en cualquier municipio.

La oferta universitaria se integró por programa, modalidad, nivel, institución, campus y ciclo. Permite comparar matrícula, nuevo ingreso, egresados, titulados, solicitudes y lugares ofertados. **Matrícula de un plantel no representa residentes del municipio**, y lugares ofertados no equivalen a capacidad física disponible. ULA y UTC se identifican como parte de Lottus según fuentes institucionales; el indicador «sin UTC» todavía incluye ULA. No usarlo como competencia externa depurada.

El inventario DENUE distingue sostenimiento y clases educativas. Se encontraron 1,636 registros de media superior (550 particulares y 1,086 públicos), 3,045 registros de secundaria (225 particulares y 2,820 públicos), 2,198 registros de varios niveles (1,577 particulares y 621 públicos). Los últimos requieren revisión antes de considerarlos feeders. Distintos registros pueden compartir sede o marca: no llamar a todo el inventario «campus únicos».

El directorio público de UTC de la tabla `utc_directorio_regional` conserva seis domicilios del entorno original y no constituye un catálogo regional completo. ANUIES sí se amplió a ambas entidades y el resumen identifica oferta UTC y ULA reportada. El directorio público aporta domicilios regionales, pero no el catálogo interno activo ni los orígenes de estudiantes. Toreo y Observatorio aparecen fuera de la alcaldía Cuajimalpa; una comparación de competencia limitada a fronteras administrativas omitiría parte de la oferta accesible. El tramo Santa Fe–Observatorio de El Insurgente ya opera en 2026; la última milla y el costo de traslado siguen siendo necesarios para evaluar accesibilidad.

Chamapa–Lechería tiene referencias oficiales de alcance distinto: 36.1 km en la ficha de proyecto que incluye ramal Lomas Verdes y 27.346 km en la referencia operativa de la vía. Se registraron ocho relaciones entre accesos sin convertir kilómetros en tiempos de viaje. La autopista por sí sola no define accesibilidad para estudiantes que viajan en transporte público.

## Cómo usar las tablas

1. Empezar por `resumen_territorial`, `demografia_municipal` y `demografia_municipal2025`; mantener separados los años y sus universos.
2. Filtrar primero por `entidad`, `alcance` o `es_zona_solicitada`. Usar `demografia_ageb` para población objetivo, escolaridad, asistencia y proxies de vivienda. No asignar niveles AMAI ni ingreso a partir de automóvil, internet o computadora.
3. Unir `demografia_ageb` con el GeoJSON por clave AGEB, conservando los no coincidentes. Hay **162 claves censales sin correspondencia** con la cartografía 2025. Las áreas y densidades son referencias mixtas 2020/2025, no densidades exactas de 2025.
4. Explorar `escuelas_denue` y `feeders_inventario` como puntos de oferta. Personal ocupado no es matrícula. Falta confirmar CCT, alumnado, niveles y acceso físico de cada feeder.
5. Filtrar `superior_programas_anuies` por un solo ciclo, nivel y modalidad comparables. Para licenciatura presencial, no mezclar posgrados o modalidades no escolarizadas. Usar `superior_campus_anuies` solamente en su grano campus/ciclo.
6. Revisar `fuentes`, `controles_calidad`, `pendientes_decision` y los diccionarios antes de crear indicadores.

### Relaciones sugeridas para Power BI

`dim_territorio[cve_municipio]` es la dimensión de municipios: relación 1 a muchos con cada tabla territorial. `demografia_ageb[cve_ageb]` puede funcionar como dimensión territorial de AGEB para hechos compatibles; separar métricas censales de esta dimensión en un modelo definitivo. No crear relaciones automáticas por nombres de municipio. Para universidades, crear dimensión con campus_id distintos y otra con ciclo; el agregado campus/ciclo no tiene campus_id único.

No relacionar programa con un establecimiento DENUE solo por nombres parecidos. No unir indicadores municipales a cada manzana y luego sumar población o pobreza repetida. El archivo `empleo_contexto_ageb` contiene **conteos de establecimientos**, no puestos de trabajo. `oferta_educativa_ageb` contiene establecimientos por clase y sostenimiento, no alumnos.

CSV originales: conservar `*`, `N/D` y demás símbolos de fuente. CSV analíticos: faltantes como celdas vacías. Cero observado y dato desconocido son distintos. No sumar porcentajes, promedios, coeficientes de variación, límites de confianza o niveles geográficos. Los rangos de 25–39 años están disponibles municipalmente en ITER; no se inventaron a escala AGEB.

## Qué sigue faltando para decidir una apertura

Se integró matrícula de secundaria CDMX por CCT/turno del ciclo2024–25 a través de AEFCM, además del agregado2025–26 por alcaldía. Sigue pendiente una extracción verificable de matrícula por CCT de bachilleratos y de secundaria Edomex: los portales SEP/SIGED presentaron bloqueos o errores de servicio. Las capas pendientes no se presentan como completadas. El IDS de Evalúa tampoco se integró por indisponibilidad del servidor.

También faltan polígonos de las colonias objetivo de Cuajimalpa, geometría exacta del eje y accesos, isócronas por modo y hora, cotizaciones comparables, inmuebles candidatos y sus costos/restricciones, y orígenes agregados de alumnos UTC/Lottus para canibalización. El complemento de jóvenes no reportados como asistentes **no es demanda convertible**. La promoción ICEL de primera parcialidad de $1,000 no es colegiatura ordinaria ni costo anual.

Por ello no se asigna un ranking final de apertura ni una meta de captación. La siguiente decisión debe hacerse sobre ubicaciones concretas, accesibilidad estudiantil y economía del plantel; las tablas entregadas permiten fundamentar esa evaluación sin confundir población, oferta y demanda.

## Trazabilidad y reproducción

`fuentes.csv` identifica productos, fechas, vínculos, archivos y estado de integración. `control_archivos_fuente.csv` registra bytes y SHA-256 de archivos adquiridos. `controles_calidad.csv` documenta integridad ZIP, unicidad ANUIES, conciliación de sexo, cobertura geográfica y símbolos reservados. Las consultas ANUIES se paginaron hasta la página final; sus respuestas se incluyen como evidencia en el paquete.

Los scripts adaptados `build_data_regional.py`, `enrich_regional.py`, `finalize_regional.py` y `prepare_regional_delivery.py` se incluyen como registro de la transformación efectuada; necesitan pandas/numpy y openpyxl (lectura de fuente CONEVAL) y los archivos originales con los nombres indicados en `data/ampliado`. El paquete no incluye todos los ZIP masivos de origen. Para repetir desde cero, ejecutar primero scripts/download_regional_sources.py desde la raíz del paquete para descargar y verificar los productos oficiales y ejecutar `expand_collect.py` para ANUIES/AGEB, `municipal_geo.py` para municipios y `build_data_regional.py` para la integración. La finalización compara con la entrega original y requiere sus CSV de control. Ajustar rutas según el directorio de trabajo. Los productos descargables pueden actualizarse: usar los hashes para verificar si se dispone de la misma edición. La consulta ANUIES depende del servicio público, que puede cambiar.

Consulta detallada de cada variable: diccionarios oficiales Censo e Intercensal, `diccionario_dataset.csv` y fuente correspondiente. Algunas columnas administrativas conservan sus nombres originales y requieren consultar la documentación de la fuente.


## Comparación regional para el dashboard

El archivo `municipios_mg2025.geojson` contiene los 141 polígonos municipales y sus claves para el mapa regional; `ageb_mg2025.geojson` contiene la cartografía urbana de ambas entidades. Unir por claves, no nombres. `cobertura_municipal.csv` expone los registros disponibles y las correspondencias geográficas.

El resumen incorpora matrícula y campus de UTC, ULA y del conjunto sin UTC/ULA para licenciatura universitaria/tecnológica escolarizada2025–26. El conjunto sin UTC/ULA incluye sostenimientos público y particular y no significa competencia externa societaria completamente auditada. No mezclarlo con los indicadores existentes por sostenimiento. No se asignó un puntaje ni una recomendación automática de apertura.

La ampliación permite comparar las zonas solicitadas con alternativas de todo el territorio. La presencia de jóvenes y oferta educativa constituye evidencia para seleccionar lugares a estudiar; no acredita rentabilidad ni demanda capturable. Las localidades rurales y las diferencias entre población urbana/municipal deben considerarse antes de priorizar un municipio extenso.


## Ampliación por nivel: bachillerato, licenciatura y maestría

Se añadieron ocho tablas. `escolaridad_edad_municipal2020` contiene17,343 filas municipales de edad/sexo y escolaridad máxima con grados aprobados, para los141 territorios. `asistencia_edad_municipal2020` contiene8,883 filas y distingue no asistencia real de no especificados. No permite cruzar individualmente escolaridad y asistencia; ambas son marginales.

`escolaridad_municipal2020` proporciona totales municipales. `segmentos_poblacion_nivel2020` reúne1,551 referencias por nivel/cohorte. Para bachillerato utiliza máxima escolaridad secundaria de3grados; para licenciatura, bachillerato de3+grados; para maestría, licenciatura/equivalente de4+grados. Los dos últimos NO certifican terminación de todos los planes de estudio. Ninguno verifica certificado/título, disposición a estudiar, capacidad de pago o captación. No titular estos indicadores «alumnos elegibles» o «demanda».

Las cohortes15–17 y18–24 concilian con el Censo municipal anterior. Para25–39 y40+ se suman grupos sin añadir simultáneamente las edades que ya contienen. Seleccionar sexo=Total o sexos separados, nunca ambos. Seleccionar agregacion_edad=Grupo para grupos completos y Edad simple solo cuando se necesite el detalle. No sumar la fila Total con grupos. Mantener el año2020 visible: no es conteo actualizado a2026 ni proyección.

`escolaridad_municipal2025` conserva los porcentajes oficiales de media superior, superior y posgrado, junto con los cinco estimadores de precisión. Incluyen algún grado aprobado; no estudios terminados. No convertirlos automáticamente a personas multiplicando por población total, porque el denominador es población15+ y la incertidumbre requiere tratamiento propio.

`feeders_secundaria_cct_cdmx2024_25` integra1,302 registros de CCT/turno de secundaria en16 alcaldías, con matrícula total, por sexo y grado. Tercergrado es matrícula al inicio del ciclo, no egresados garantizados. Un CCT no equivale automáticamente a un inmueble físico. No se forzó una unión por parecido de nombre con DENUE; coordenadas y correspondencia se validan después.

`secundaria_alcaldia_cdmx2025_26` ofrece los agregados más recientes por alcaldía/sostenimiento. Global ya incluye los otros sostenimientos; no sumarlos juntos. No repartir estos totales entre CCT del ciclo anterior.

`flujo_licenciatura_anuies` incluye licenciatura universitaria y tecnológica; permite revisar matrícula, nuevoingreso, egresados y titulados reportados por municipio del plantel, ciclo, sostenimiento y modalidad. Sirve como contexto del flujo hacia posgrado; no informa residencia ni intención de esos egresados. El hecho de tener grado o título no acredita demanda de maestría.

Para PowerBI: relacionar estas tablas con dim_territorio por cve_municipio (texto). Segmentos debe filtrarse por un nivel objetivo; los indicadores de distinto requisito educativo no forman una meta conjunta de captación. Mantener separados stocks de residentes2020, porcentajes2025 y flujos educativos por ciclo. La base ya permite construir tres vistas educativas comparables; no sustituye datos internos de conversión, origen de alumnos, becas, ingreso o una encuesta de interés.
