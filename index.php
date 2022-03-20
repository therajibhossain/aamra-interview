<?php 

    class Employee {

        protected $employeesData = [
            ['date' => '01/03/2022', 'role' => 'Manager', 'name' => 'Kamal'],
            ['date' => '01/03/2022', 'role' => 'Sr. Manager', 'name' => 'Jamal'],
            ['date' => '01/03/2022', 'role' => 'Deputy Manager', 'name' => 'John'],
            ['date' => '05/03/2022', 'role' => 'Manager', 'name' => 'Kamal'],
            ['date' => '05/03/2022', 'role' => 'Sr. Manager', 'name' => 'Jamal'],
            ['date' => '05/03/2022', 'role' => 'Deputy Manager', 'name' => 'John'],
        ];
    }

    class Question1 extends Employee {  

        private $headers = [];
        private $groupEmpByRole = [];

        public function output() {
            $this->groupEmpData();
            $output = $this->view();
            echo $output;
        }

        private function groupEmpData() {
            foreach($this->employeesData as $employee) {
                $this->headers[] = $employee['date'];            
                $this->groupEmpByRole[$employee['role']][] = $employee;
            }

            $this->headers = array_unique($this->headers);
            sort($this->headers);
            return;
        }

        private function view() {
            $html = '<table>
                <thead>
                    <tr>
                        <th>Role</th>';
                        foreach($this->headers as $header) {
                            $html .= '<th>'.$header.'</th>';
                        }
                    $html .= '</tr>
                </thead>
                <tbody>';

                foreach($this->groupEmpByRole as $index => $groupEmp) {
                    $html .= '<tr>';
                    $html .= '<td>'.$groupEmp[0]['role'].'</td>';
                    foreach($groupEmp as $employee) {
                        $html .= '<td>'.$employee['name'].'</td>';                   
                    }
                    $html .= '</tr>';
                }

            $html .= '</tbody>
            </table>';

            return $html;
        }
    }

    class Question2 extends Employee {  

        private $headers = [];
        private $groupEmpByRole = [];

        public function output() {
            $this->groupEmpData();
            $output = $this->view();
            echo $output;
        }

        private function groupEmpData() {
            $empData = $this->employeesData;

            $startDate = ($empData[0]['date']);
            $endDate = (end($empData)['date']);

            $explodeStartDate = explode('/', $startDate);
            $explodeEndDate = explode('/', $endDate);
            $startDay = (int) $explodeStartDate[0];
            $endDay = (int) $explodeEndDate[0];
            $month = $explodeStartDate[1];
            $year = $explodeStartDate[2];

            for($i = $startDay; $i <= $endDay; $i++) {
                $newDate = sprintf("%02d", $i).'/'.$month.'/'.$year;
                $this->headers[] = $newDate;
            }

            $this->headers = array_unique($this->headers);
            sort($this->headers);
                
            foreach($this->employeesData as $employee) {         
                $this->groupEmpByRole[$employee['role']][] = $employee;
            }
            
            return;
        }

        private function view() {
            $html = '<table>
                <thead>
                    <tr>
                        <th>Role</th>';
                        foreach($this->headers as $header) {
                            $html .= '<th> '.$header.' </th>';
                        }
                    $html .= '</tr>
                </thead>
                <tbody>';

                foreach($this->groupEmpByRole as $index => $groupEmp) {
                    $html .= '<tr>';
                    $html .= '<td>'.$groupEmp[0]['role'].'</td>';
                    foreach($groupEmp as $employee) {
                        $date = $employee['date'];
                        foreach($this->headers as $index => $header) {
                            if($header === $date) {
                                $html .= '<td>'.$employee['name'].'</td>'; break;
                            }elseif($index > 0) {
                                $html .= '<td>-</td>';
                            }
                        }                  
                    }
                    $html .= '</tr>';
                }

            $html .= '</tbody>
            </table>';

            return $html;
        }

    }

    //solving question 1
    $question1 = new Question1();
    $question1->output();
    echo '<br />';

    //solving question 2
    $question2 = new Question2();
    $question2->output();
?>


<style>
    table, th, td {
        border: 1px solid black;
    }
</style>