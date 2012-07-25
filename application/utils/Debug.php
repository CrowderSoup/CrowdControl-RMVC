<?php
    
    class Debug
    {
        public function PrintArray($aVals)
        {
            $strReturn = '<ul>';
            foreach($aVals as $key => $val)
            {
                if(is_array($val))
                {
                    $strReturn .= '<li><strong>' . $key . '</strong>';
                    $strReturn .= PrintArray($val);
                    $strReturn .= '</li>';
                }
                else
                    $strReturn .= '<li>' . $key . ' - ' . $val . '</li>';
            }
            $strReturn .= '</ul>';

            return $strReturn;
        }
        
        public function 
    }
    
?>
