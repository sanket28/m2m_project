package callbacks;

import com.dcsquare.hivemq.spi.callback.CallbackPriority;
import com.dcsquare.hivemq.spi.callback.exception.AuthenticationException;
import com.dcsquare.hivemq.spi.callback.security.OnAuthenticationCallback;
import com.dcsquare.hivemq.spi.message.ReturnCode;
import com.dcsquare.hivemq.spi.security.ClientCredentialsData;
import com.google.common.base.Strings;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.DriverManager;



/**
 * Created by sanketdeshpande on 05/01/14.
 */
public class ClientAuthenticate implements OnAuthenticationCallback {

    Logger log = LoggerFactory.getLogger(ClientAuthenticate.class);



    @Override
    public Boolean checkCredentials(ClientCredentialsData clientData) throws AuthenticationException {
        boolean flag=false;


        String domainid;
        if (!clientData.getUsername().isPresent()) {
            throw new AuthenticationException("No Domain ID provided", ReturnCode.REFUSED_NOT_AUTHORIZED);
        }
        domainid = clientData.getUsername().get();


        if (Strings.isNullOrEmpty(domainid)) {
            throw new AuthenticationException("No Domain ID provided", ReturnCode.REFUSED_NOT_AUTHORIZED);
        }

        String deviceserial;
        if (!clientData.getPassword().isPresent()) {
            throw new AuthenticationException("No Serial Number provided", ReturnCode.REFUSED_NOT_AUTHORIZED);
        }
        deviceserial = clientData.getPassword().get();
        //System.out.printf(deviceserial);

        if (Strings.isNullOrEmpty(deviceserial)) {
            throw new AuthenticationException("No Serial Number provided", ReturnCode.REFUSED_NOT_AUTHORIZED);
        }


            Connection connection = null;
            Statement statement = null;
            ResultSet resultSet = null;

            try {

                System.out.println("Connecting to database..");
                Class.forName("com.mysql.jdbc.Driver");
                connection = DriverManager.getConnection("jdbc:mysql://us-cdbr-east-04.cleardb.com:3306/ad_8c8d158234a92d0", "b4ae5754215d7e", "507f4753");
                System.out.println("Connection Successful");
                statement = connection.createStatement();
                resultSet = statement.executeQuery("SELECT domainid1, serialnumber  FROM registerdevice");

                //System.out.println("selected");


                while (resultSet.next())
                {
                    String domainid1 = resultSet.getString("domainid1");
                    String serialnumber = resultSet.getString("serialnumber");

                    if (domainid.equals(domainid1))
                    {
                        System.out.println("Domain ID match found");
                        if (deviceserial.equals(serialnumber))
                        {
                            System.out.println("Serial number match found");
                            flag = true;
                            break;
                        }


                    }
                    else
                    {
                        System.out.println("No match found");

                    }
                }
            }

            catch(ClassNotFoundException error){
               System.out.println("Error :" + error.getMessage());
            }

            catch(SQLException error){
                System.out.println("Error: " + error.getMessage());
            }
            finally{
                if (connection !=null) try{connection.close();} catch(SQLException ignore){}
                if (statement !=null) try{statement.close();} catch(SQLException ignore){}
                if (resultSet !=null) try{resultSet.close();} catch(SQLException ignore){}
            }

            if(flag==false)
            {
                return false;
            }
    return true;
    }
        @Override
        public int priority() {
        return CallbackPriority.HIGH;
    }
}
