<p align="center">
  <h3 align="center">GitHub Readme Streak Stats</h3>
</p>

<p align="center">
  Muestra tu total de contribuciones, racha actual
  <br/>
  y racha más larga en el README de tu perfil de GitHub
</p>

## ⚡ Configuración rápida

1. Copia y pega el siguiente markdown en el README de tu perfil de GitHub
2. Reemplaza el valor después de `?user=` con tu nombre de usuario de GitHub
3. Apunta la URL a tu propia instancia desplegada (ver [Despliegue](#-despliegue))

```md
![GitHub Streak](https://TU-INSTANCIA.vercel.app/?user=jeanpierre-max)
```

## 🔧 Opciones

El campo `user` es el único parámetro obligatorio. Todos los demás son opcionales.

Si se especifica el parámetro `theme`, cualquier personalización de color que se indique se aplicará encima del tema, sobreescribiendo sus valores.

|         Parámetro          |                     Descripción                      |                                              Ejemplo                                               |
| :------------------------: | :--------------------------------------------------: | :------------------------------------------------------------------------------------------------: |
|           `user`           |        Nombre de usuario de GitHub                   |                                           `jeanpierre-max`                                         |
|          `theme`           |     Tema a aplicar (predeterminado: `default`)       |                          `dark`, `radical`, etc. (ver [src/themes.php](./src/themes.php))           |
|       `hide_border`        |  Hace el borde transparente (predeterminado: `false`)| `true` o `false`                                                                                   |
|      `border_radius`       | Redondez de los bordes (predeterminado: `4.5`)       | Número `0` (esquinas rectas) hasta `248` (elipse)                                                  |
|        `background`        |  Color de fondo (ej. `f2f2f2`, `35,d22,00f`)        | **código hex** sin `#`, **color CSS**, o degradado en formato `ángulo,color_inicio,...,color_fin`  |
|          `border`          |                   Color del borde                    |                             **código hex** sin `#` o **color CSS**                                 |
|          `stroke`          |        Color de la línea divisora entre secciones    |                             **código hex** sin `#` o **color CSS**                                 |
|           `ring`           |   Color del anillo alrededor de la racha actual      |                             **código hex** sin `#` o **color CSS**                                 |
|           `fire`           |          Color del fuego en el anillo                |                             **código hex** sin `#` o **color CSS**                                 |
|      `currStreakNum`       |              Número de racha actual                  |                             **código hex** sin `#` o **color CSS**                                 |
|         `sideNums`         |         Números de totales y racha más larga         |                             **código hex** sin `#` o **color CSS**                                 |
|     `currStreakLabel`      |               Etiqueta de racha actual               |                             **código hex** sin `#` o **color CSS**                                 |
|        `sideLabels`        |         Etiquetas de totales y racha más larga       |                             **código hex** sin `#` o **color CSS**                                 |
|          `dates`           |              Color del texto de fechas               |                             **código hex** sin `#` o **color CSS**                                 |
|     `excludeDaysLabel`     |       Color del texto de días excluidos              |                             **código hex** sin `#` o **color CSS**                                 |
|       `date_format`        |  Formato de fecha o vacío para formato por locale    |                        Consulta la nota sobre [📅 Formatos de fecha](#-formatos-de-fecha)           |
|          `locale`          |  Locale para etiquetas y números (predeterminado: `en`) |                         Código ISO 639-1, ej. `es`                                                 |
|      `short_numbers`       |  Usar números cortos (ej. 1.5k en lugar de 1.500)   |                                         `true` o `false`                                           |
|           `type`           |          Formato de salida (predeterminado: `svg`)   |                              Opciones: `svg`, `png` o `json`                                       |
|           `mode`           |          Modo de racha (predeterminado: `daily`)     |             `daily` (contribuir diariamente) o `weekly` (una vez por semana dom-sáb)               |
|       `exclude_days`       | Días de la semana a excluir de las rachas            |    Lista separada por comas (Sun, Mon, Tue, Wed, Thu, Fri, Sat) ej. `Sun,Sat`                      |
|    `disable_animations`    |    Desactiva las animaciones SVG (predeterminado: `false`) |                                     `true` o `false`                                          |
|        `card_width`        |   Ancho de la tarjeta en píxeles (predeterminado: `495`) |                     Entero positivo, ancho mínimo 100px por columna                             |
|       `card_height`        |  Alto de la tarjeta en píxeles (predeterminado: `195`)   |                          Entero positivo, alto mínimo 170px                                    |
| `hide_total_contributions` | Oculta el total de contribuciones (predeterminado: `false`) |                                     `true` o `false`                                        |
|   `hide_current_streak`    |    Oculta la racha actual (predeterminado: `false`)  |                                         `true` o `false`                                           |
|   `hide_longest_streak`    |    Oculta la racha más larga (predeterminado: `false`) |                                       `true` o `false`                                             |
|      `starting_year`       |          Año de inicio de contribuciones             |   Entero, debe ser `2005` o posterior, ej. `2017`. Por defecto usa el año de creación de la cuenta. |

### 🖌 Temas

Para activar un tema, agrega `&theme=` seguido del nombre del tema al final de la URL:

```md
![GitHub Streak](https://TU-INSTANCIA.vercel.app/?user=jeanpierre-max&theme=dark)
```

Consulta la lista completa de temas disponibles en [src/themes.php](./src/themes.php).

### 🗪 Idiomas

El parámetro `locale` acepta cualquier código ISO de idioma o locale. El locale indicado se usará para el formato de fecha y número aunque no haya traducciones disponibles para las etiquetas. Las traducciones disponibles se encuentran en [src/translations.php](./src/translations.php).

### 📅 Formatos de fecha

Si `date_format` no se proporciona o está vacío, la librería PHP Intl determina el formato de fecha según el locale especificado en el parámetro `locale`.

Se puede especificar un formato de fecha personalizado pasando una cadena al parámetro `date_format`.

El formato requerido usa caracteres de la [función date de PHP](https://www.php.net/manual/en/datetime.format.php), con corchetes alrededor de la parte que representa el año. Cuando el año de la contribución es igual al año actual, los caracteres entre corchetes se omiten.

**Ejemplos:**

|     Formato de fecha    |                                     Resultado                                      |
| :---------------------: | :--------------------------------------------------------------------------------: |
| <pre>d F[, Y]</pre>     | <pre>"2020-04-14" => "14 April, 2020"<br/><br/>"2024-04-14" => "14 April"</pre>   |
|  <pre>j/n/Y</pre>       | <pre>"2020-04-14" => "14/4/2020"<br/><br/>"2024-04-14" => "14/4/2024"</pre>       |
| <pre>[Y.]n.j</pre>      | <pre>"2020-04-14" => "2020.4.14"<br/><br/>"2024-04-14" => "4.14"</pre>            |
| <pre>M j[, Y]</pre>     | <pre>"2020-04-14" => "Apr 14, 2020"<br/><br/>"2024-04-14" => "Apr 14"</pre>       |

### Ejemplo

```md
![GitHub Streak](https://TU-INSTANCIA.vercel.app/?user=jeanpierre-max&currStreakNum=2FD3EB&fire=pink&sideLabels=F00&date_format=[Y.]n.j)
```

## ℹ️ Cómo se calculan estas estadísticas

Esta herramienta utiliza los gráficos de contribuciones de tu perfil de GitHub para determinar en qué días has contribuido.

Para incluir contribuciones en repositorios privados, activa la opción "Private contributions" en el menú desplegable sobre el gráfico de contribuciones de tu perfil.

Las contribuciones incluyen commits, pull requests e issues que crees en repositorios independientes.

La racha más larga es el mayor número de días consecutivos en los que hiciste al menos una contribución.

La racha actual es el número de días consecutivos hasta el día de hoy en los que hiciste al menos una contribución. Si contribuiste hoy, se cuenta en la racha actual; si no contribuiste hoy, la racha solo cuenta los días anteriores para que no quede en cero.

> [!NOTE]
> Es posible que debas esperar hasta 24 horas para que las nuevas contribuciones aparezcan.

## 📤 Despliegue

Los archivos PHP pueden desplegarse en cualquier servidor con PHP instalado. La opción recomendada es **Vercel** (gratuita).

> [!NOTE]
> En Vercel el modo PNG no está soportado (Inkscape no se instala), pero el modo SVG predeterminado funciona correctamente.

<details>
  <summary><b>Instrucciones para desplegar en Vercel</b></summary>

1. Asegúrate de alojar la rama **`vercel`** (de lo contrario obtendrás un error 404). Puedes establecerla como predeterminada.
2. Instala el CLI de Vercel: `npm i -g vercel`
3. Ejecuta `vercel` y sigue las instrucciones para vincular tu cuenta y elegir un nombre de proyecto.
4. Crea un Personal Access Token en GitHub (no necesitas seleccionar permisos): <https://github.com/settings/tokens/new>
5. En el dashboard de Vercel → tu proyecto → **Settings** → **Environment Variables**, agrega una variable con clave `TOKEN` y el valor del token generado.
6. (Opcional) Establece la variable `WHITELIST` para restringir qué usuarios pueden consultarse (lista separada por comas). Si no se establece, se puede acceder a cualquier usuario de GitHub.
7. Redesplega con `vercel --prod` para aplicar las variables de entorno.

</details>

<details>
  <summary><b>Instrucciones para desplegar con Docker</b></summary>

```bash
# Construir la imagen
docker build -t streak-stats .

# Ejecutar el contenedor con tu token de GitHub
docker run -d -p 8080:80 -e TOKEN=tu_token_de_github streak-stats

# Opcional: restringir el acceso a ciertos usuarios
docker run -d -p 8080:80 -e TOKEN=tu_token_de_github -e WHITELIST=jeanpierre-max streak-stats
```

Visita http://localhost:8080 para acceder a tu instancia. Docker soporta todas las funcionalidades, incluido el renderizado PNG con Inkscape.

</details>

---

Hecho con PHP.
