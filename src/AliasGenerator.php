<?php

namespace JLaso;

class AliasGenerator extends BaseGenerator
{
    // important question: coded alias is coupled to $base array
    protected $base = array (
        // the purpose of this apparent disorder is to obtain a pseudo-random
        // alias, an alias that can be decoded and get original id
        '#VaRCSc,ev0fNj;k9HDGlmT.obPq7rIs-Ytux5yzAgB_E4pFihUJnK3LMd&O1Q6XZ',
        'JK3LMN&!tuvx5yzABC_DE4FGHIOP1QRSTUV6XYZabc,de0fghij;k9lmn.opq7rs-',
        'STUV6XYZabc,de0fghij;k9lmK3LMNn.opq7rs-!tuv&OP1QRx5yzABC_DE4FGHIJ',
        'OP1QR;k9lmn.opq7rsSTdzABC_DEuJK3LMN4FGHe0fghij!t-&vx5yUV6XYZabc,I',
        'lmn.op_DE4FGHe0fghij!tuJK3LMNvx5q7rsSTdzABC,I-&OPyUV6XYZabc1QR;k9',
        'vx5yzABC_DE4FGHUV6XYZ;k9lmn.opq7rs-&OP1QRSTde0fghij!tuabc,IJK3LMN',
        'TdzABC,I-&OPyUV6XYZabc1QR;k9lmn.op_DE4FGHe0fghij!tuJK3LMNvx5q7rsS',
        'QRSTde0fghij!tuabc,IJK3LMNvx5yzABC_DE4FGHUV6XYZ;k9lmn.opq7rs-&OP1',
        '4FGHe0fghij!t-&OP1QR;k9lmn.opq7rsSTdzABC_DEuJK3LMNvx5yUV6XYZabc,I',
        'q7rsSTdzABC,I-&OPyUV6XYZabc1QR;k9lmn.op_DE4FGHe0fghij!tuJK3LMNvx5',
        // you can continue (or not), it's a cycled code, for digit 11th it'll
        // start at 0 again
    );
}
