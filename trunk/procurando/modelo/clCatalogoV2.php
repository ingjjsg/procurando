<?php

/*
 * Copyright (c) 2009 Nguyen Duc Thuan <me@ndthuan.com>
 * All rights reserved.
 */

class Fete_ViewControl_DataGrid
{
    protected $_columns         = array();
    protected $_headers         = array();
    protected $_cellTemplates   = array();
    protected $_enabledSorting  = false;
    protected $_sortableFields  = array();
    protected $_alterRowClass   = null;
    protected $_rowClass        = null;
    protected $_datarows        = array();
    protected $_tableId         = 0;
    protected $_cellAttributes  = array();
    protected $_gridAttributes  = array();
    protected $_startingCounter = 0;

    protected static $_staticTableId    = 0;

    /**
     *
     * @param array $datarows
     * @return Fete_ViewControl_DataGrid
     */
    public static function getInstance($tabla='',$sql ="" ,$campos = array(),$filas=1,$name='a',$condicionales = array(),$filtros=50)
    {
        return new self($tabla,$sql,$campos,$filas,$name,$condicionales,$filtros);
    }

    public function __construct($tabla='',$sql = array(),$campos = array(),$filas=1,$name='a',$condicionales,$filtros=50)
    {
        $paging = new PHPPaging;
        $paging->agregarConsulta($sql);
        $paging->ejecutar();
        $datarows=$paging->fetchTodo();
        $this->_filas_buscadas=count($datarows);
	    $navegacion.= "<div style='background-color: #eee;border: 1px solid #ccc;margin: 2px auto;text-align: center;padding: 9px 5px;white-space: nowrap;font: 11px Georgia;'>".$paging->fetchNavegacion();
	    $navegacion.= "<br /><b>Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />";
	    $navegacion.= "Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro();
	    $navegacion.= " de un total de ".$paging->numTotalRegistros()."</div>";

		$vacio="";
		$arreglo=array();
	        $i=0;
	        while ($i<$filas)
	        {
	          $j=0;
	          while ($j<count($campos))
	          {
	            $arreglo+= array($campos[$j] => $vacio);
	            $j++;
	          }
	    	  if (!isset($datarows[0]))
			$datarows[]=$arreglo;
 		  else
			$datarows[count($datarows)]=$arreglo;
	          $i++;
	        }
        $this->_tabla = $tabla;
        $this->_name = $name;
        $this->_datarows = $datarows;
        $this->_condicionales = $condicionales;
        $this->_filtros = $filtros;
        $this->_campos = $campos;
        $this->_navegacion = $navegacion;
        if (isset($datarows[0])) {
            foreach ($datarows[0] as $field => $value)
            {
            	if (!is_numeric($field))
            	{
	                $this->_columns[] = $field;
	                $this->_sortableFields[] = $field;
            	}
            }
        }

        $this->_tableId = ++self::$_staticTableId;
        $this->_gridAttributes['id'] = 'fdg_' . $this->_tableId;
    }

    /**
     *
     * @param boolean $enabled
     * @return Fete_ViewControl_DataGrid
     */
    public function &enableSorting($enabled)
    {
        $this->_enabledSorting = $enabled;

        return $this;
    }

    /**
     *
     * @param array $settings
     * @return Fete_ViewControl_DataGrid
     */
    public function &setup($settings)
    {
        foreach ($settings as $field => $setting)
        {
            if (isset($setting['header'])) {
                $this->_headers[$field] = $setting['header'];
            }

            if (isset($setting['cellTemplate'])) {
                $this->_cellTemplates[$field] = $setting['cellTemplate'];
            }

            if (isset($setting['attributes'])) {
                $this->_cellAttributes[$field] = $setting['attributes'];
            }
        }

        return $this;
    }

    /**
     *
     * @param array $attributes
     * @return Fete_ViewControl_DataGrid
     */
    public function &setGridAttributes($attributes)
    {
        foreach ($attributes as $name => $value)
        {
            $this->_gridAttributes[$name] = $value;
        }

        return $this;
    }

    /**
     *
     * @param string $name
     * @param string $value
     * @return Fete_ViewControl_DataGrid
     */
    public function &setGridAttribute($name, $value)
    {
        $this->_gridAttributes[$name] = $value;

        return $this;
    }

    /**
     *
     * @param string $field
     * @param string $template
     * @return Fete_ViewControl_DataGrid
     */
    public function &setCellTemplate($field, $template)
    {
        $this->_cellTemplates[$field] = $template;

        return $this;
    }

    /**
     *
     * @param string $field
     * @param array $attributes
     * @return Fete_ViewControl_DataGrid
     */
    public function &setCellAttributes($field, $attributes)
    {
        if (isset($this->_cellAttributes[$field])) {
            foreach ($attributes as $name => $value)
            {
                $this->_cellAttributes[$field][$name] = $value;
            }
        } else {
            $this->_cellAttributes[$field] = $attributes;
        }

        return $this;
    }

    /**
     *
     * @param string $field
     * @param string $name
     * @param string $value
     * @return Fete_ViewControl_DataGrid
     */
    public function &setCellAttribute($field, $name, $value)
    {
        if (isset($this->_cellAttributes[$field])) {
            $this->_cellAttributes[$field][$name] = $value;
        }

        $this->_cellAttributes[$field] = array($name => $value);

        return $this;
    }

    /**
     *
     * @param string $field
     * @param string $header
     * @return Fete_ViewControl_DataGrid
     */
    public function &setHeader($field, $header)
    {
        $this->_headers[$field] = $header;

        return $this;
    }

    /**
     *
     * @param string $columnName
     * @return Fete_ViewControl_DataGrid
     */
    public function &removeColumn($columnName)
    {
        $counter = 0;
        foreach ($this->_columns as $column)
        {
            if ($column === $columnName) {
                array_splice($this->_columns, $counter, 1);
                return $this;
            }
            ++$counter;
        }

        return $this;
    }

    /**
     *
     * @param string $columnName
     * @param string $cellTemplate
     * @param string $header
     * @param array $attributes
     * @return Fete_ViewControl_DataGrid
     */
    public function &addColumnBefore($columnName, $cellTemplate = '', $header = '', $attributes = array())
    {
        $this->_columns = array_merge(array($columnName), $this->_columns);
        $this->_cellTemplates[$columnName] = $cellTemplate;
        $this->_headers[$columnName] = $header;
        $this->_cellAttributes[$columnName] = $attributes;

        return $this;
    }

    /**
     *
     * @param string $columnName
     * @param string $cellTemplate
     * @param string $header
     * @param array $attributes
     * @return Fete_ViewControl_DataGrid
     */
    public function &addColumnAfter($columnName, $cellTemplate = '', $header = '', $attributes = array())
    {
        $this->_columns[] = $columnName;
        $this->_cellTemplates[$columnName] = $cellTemplate;
        $this->_headers[$columnName] = $header;
        $this->_cellAttributes[$columnName] = $attributes;

        return $this;
    }

    /**
     *
     * @param string $cssClass
     * @return Fete_ViewControl_DataGrid
     */
    public function &setRowClass($cssClass)
    {
        $this->_rowClass = $cssClass;

        return $this;
    }

    /**
     *
     * @param string $cssClass
     * @return Fete_ViewControl_DataGrid
     */
    public function &setAlterRowClass($cssClass)
    {
        $this->_alterRowClass = $cssClass;

        return $this;
    }

    /**
     *
     * @param integer $counter
     * @return Fete_ViewControl_DataGrid
     */
    public function &setStartingCounter($counter)
    {
        $this->_startingCounter = $counter;

        return $this;
    }

    public function getString()
    {
        $sortField  = '';
        $sortOrder  = '';
        $data       = $this->_datarows;

        if ($this->_enabledSorting && isset($_POST['__sf'])) {
            $sortField = $_POST['__sf'];
            $sortOrder = $_POST['__so'];

            $dataToSort = array();
            foreach ($data as $row)
            {
                $dataToSort[] = $row[$sortField];
            }

            array_multisort($dataToSort, 'desc' === $sortOrder ? SORT_DESC : SORT_ASC, $data);
        }
        $output = '';

        $output .='<div  class="titulo"><Form Name="search" onSubmit="return BuscarPalabras(this.string.value);">
                <Font Size=2>Busqueda General <Input Name="string" class="inputbox" Type=Text Size=15 onChange="n = 0;">
                <Input Type="submit" class="inputbox" Value="BUSCAR">
                </Font>
                </Form></div>';



        if ($this->_enabledSorting) {
            $output .= '
			<div id="grid_scroll"><form id="fdg_form_' . $this->_tableId . '" method="post" action="' . $_SERVER['REQUEST_URI'] . '">
			<input type="hidden" id="'.$this->_name.'__sf" name="'.$this->_name.'__sf" value="" />
			<input type="hidden" id="'.$this->_name.'__so" name="'.$this->_name.'__so" value="" />';
        }
        $output .= '<table class="tablaTitulo" width="100%">
                    <thead>
					<tr>
						<td bgcolor="#f8f8f8" style="border: 1px solid rgb(204, 204, 204);" colspan="6">
						<div align="center" style="background-image: url(../comunes/images/barra.png);"><strong>Filtros</strong>
						</div>
						</td>
					</tr>

                    <tr >
                    <th >Campo</th>
                    <th >Condición</th>
                    <th >Variable</th>
                    <th >Acciones</th>
                    </tr>
                    </thead>
                    <tbody>';
        $i=0;
        while($i < $this->_filtros)
        {
                 $drop_down_campos="";
                 $drop_down_condicionales="";
                    $clase_id = $i % 2;
                    if (0 === $clase_id) {
                        $clase= ' ';
                    } else {
                        $clase= ' class="alterRow" ';
                    }
                 if ($i==0)
                 {
                     $output .='<tr  bgcolor="#f8f8f8" '.$clase.' id="'.$i.'" >';
                     $output .='<input type="hidden" name="activo_'.$i.'" id="activo_'.$i.'"value="A" />';
                 }
                 else
                 {
                     $output .='<tr  bgcolor="#f8f8f8" '.$clase.' id="'.$i.'" style="display: none;">';
                     $output .='<input type="hidden" name="activo_'.$i.'" id="activo_'.$i.'"value="O" />';
                 }
                    $output .="<td align='center'>";

                           $output .= '<select id="campos_'.$i.'" name="campos_'.$i.'"  class="inputbox"><option value="">Seleccione</option>';
                        foreach ($this->_campos as $value_campos => $campos_tabla)
                        {
                            $drop_down_campos .= "<option  value='".$value_campos."'>". $campos_tabla . "</option>";
                        }
                       $output .=$drop_down_campos."</select>";
                    $output .="</td>";
                    $output .="<td  align='center' >";
                        $output .= '<select name="condicionales_'.$i.'" id="condicionales_'.$i.'"  class="inputbox"><option value="">Seleccione</option>';
                        foreach ($this->_condicionales as $name => $value)
                        {
                            $drop_down_condicionales .= "<option  value='".$value."'>". $name . "</option>";
                        }
                        $output .=$drop_down_condicionales."</select>";
                    $output .="</td>";
                    $output .="<td align='center'>";
                        $output .= '<input type="text" class="inputbox" name="input_'.$i.'" id="input_'.$i.'" value="" />';
                    $output .="</td>";
                    $fila_evento=$i+1;
                    if ($i==0)
                      $output .='<td align="center"><a><img src="../comunes/images/textfield_add.png" onclick="agregar_filtro(\''.$fila_evento.'\');" />';
                    else
                      $output .='<td><a><img src="../comunes/images/textfield_add.png" onclick="agregar_filtro(\''.$fila_evento.'\');" /></a>
                                   <a><img src="../comunes/images/textfield_delete.png" onclick="ocultar_filtro(\''.$i.'\');" /></a>';
                    $output .="</td>";
                 $output .="</tr>";
            $i++;
        }

        $output .= ' <tr><td>&nbsp;</td></tr>';
        $output .= '<tr><td colspan="4"  align="right"><input onclick="verificar_filtros()"; type="submit" style="" class="inputbox" name="ver" value="Filtrar"/></td></tr>';
        $output .="</tbody>
        </table>";
        //$output .="</br>";

        //$output .='<div style="float:left;margin-left:457px"><input type="submit" style="" class="inputbox" name="ver" value="Filtrar"/></div>';
        //$output .="</br></br>";
        $output .="</br>";
        $output .= '
		<table class="tabla_contenido" width="100%"';

        foreach ($this->_gridAttributes as $name => $value)
        {
            $output .= ' ' . $name. '="' . $value . '"';
        }

        $output .= '>' . "\n";

        if (!empty($this->_headers)) {
            $numero_filas=0;
            foreach ($this->_columns as $field)
            {
                $numero_filas++;
                $isSortable = in_array($field, $this->_sortableFields) ? true : false;

                $output .= "\t" . '<th class="cabecera_tabla" ';

                if ($this->_enabledSorting && $isSortable) {
                    $output .= ' onclick="document.getElementById(\'fdg_form_' . $this->_tableId . '\').setAttribute(\'action\', self.location.href);document.getElementById(\'__sf\').value=\'' . $field . '\';document.getElementById(\'__so\').value=\'' . (('' === $sortOrder && '' === $sortField) || $sortField !== $field || ('desc' === $sortOrder  && $field === $sortField) ? 'asc' : 'desc') . '\'; document.getElementById(\'fdg_form_' . $this->_tableId . '\').submit();"';
                }

                $output .= ' id="fdg_' . $this->_tableId . '_header_' . $field . '" class="fdg_' . $this->_tableId . '_header' . ($this->_enabledSorting && $isSortable ? ' fdg_sortable' : '') . ($field === $sortField ? ' fdg_sort_' . $sortOrder : '') . '">' . (isset($this->_headers[$field]) ? $this->_headers[$field] : '') . '</th>' .  "\n";
            }

            $output .= '</tr>' .  "\n";
        }

        if (isset($this->_datarows[0])) {
            $counter = 0;
			$numero_filas=$numero_filas-2;
            foreach ($data as $offset => $row)
            {
                ++$counter;
                $rowCounter = $offset + $this->_startingCounter;
                $p=1;
                foreach ($this->_columns as $field)
                {

                    if ($p==1)
                    {
                    	$prueba=$row[$field];
                    	if ($this->_filas_buscadas>=$counter)
                    	{
                            $output .= '<tr id="'.$this->_name.'_fila_'.$rowCounter.'">';
                            $output .= '<input id="'.$this->_name.'_bol_'.$rowCounter.'" type="hidden" value="'.$this->_columns[4].'" />';
                            $output .= '<input id="'.$this->_name.'_vis_'.$rowCounter.'" type="hidden" value="S" />';
                    	}
                    	else
                    	{
                            $output .= '<tr id="'.$this->_name.'_fila_'.$rowCounter.'" style="display:none;">';
                            $output .= '<input id="'.$this->_name.'_bol_'.$rowCounter.'" type="hidden" value="'.$this->_columns[4].'" />';
                            $output .= '<input id="'.$this->_name.'_vis_'.$rowCounter.'" type="hidden" value="N" />';
                    	}
                    }


                    $output .= '<input value="'.$rowCounter.'" type="hidden" id="'.$this->_name.'_'.$row[$field].'" />';
                    $data  = isset($row[$field]) ? '<input  class="inputtext" id="'.$this->_name.'_'.$rowCounter.'-'.$p.'" type="text" readonly="true" size="'.strlen($row[$field]).'" value="'.$row[$field].'" />'.$catalogo : '';
                    $template   = isset($this->_cellTemplates[$field]) ? $this->_cellTemplates[$field] : '';

                    $output .= "\t" . '<td';

                    if (isset($this->_cellAttributes[$field])) {
                        foreach ($this->_cellAttributes[$field] as $name => $value)
                        {
                            $output .= ' ' . $name . '="' . $value . '"';
                        }
                    }

                    $reminder = $counter % 2;

                    if (0 === $reminder && null !== $this->_alterRowClass) {
                        $output .= ' class="' . $this->_alterRowClass . '"';
                    } elseif (0 < $reminder && null !== $this->_rowClass) {
                        $output .= ' class="' . $this->_alterRowClass . '"';
                    }

                    $output .= '>';

                    if (!empty($template)) {
                        $data = str_replace('%data%', $data, $template);
                        $data = str_replace('%counter%', $rowCounter, $data);
                        $data = preg_replace('#(\$(.+?)\$)#sie', 'isset($row["\\2"]) ? $row["\\2"] : \'\\1\'', $data);
                        preg_match_all('#\[\[([a-z0-9_]+)(?::(.+?))?\]\]#si', $data, $matches, PREG_SET_ORDER);

                        foreach ($matches as $match)
                        {
                            if (isset($match[2])) {
                                $params = explode(',', $match[2]);
                            } else {
                                $params = array();
                            }
                            $data = str_replace($match[0], call_user_func_array($match[1], $params), $data);
                        }
                    }
                    $output .= $data . '</td>' . "\n";
                    $p++;
                }
                $output .= '</tr>' . "\n";
            }
        }
        $output .= '</table>';
        $output.=$this->_navegacion;

        if ($this->_enabledSorting) {
            $output .= '
			</form></div>';
        }

        return $output;
    }

    public function render()
    {
        return $this->getString();
    }

    public function  __toString()
    {
        return $this->getString();
    }
}
