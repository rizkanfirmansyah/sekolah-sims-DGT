<?php
//config.php
$host="localhost";
$username="root";
$password="";
$db="penjualan";
 
mysql_connect($host, $username, $password) or die("GAGAL");
mysql_select_db($db) or die("database tidak ada");
 
$find_db = mysql_select_db($db);
?>

//service.php  (JSON)
<?php
require_once "config.php";
$query ="SELECT * FROM tbbarang";
$result = mysql_query($query) or die ('Errorquery: '.query);
 
$row = array();
while($r = mysql_fetch_assoc($result)){
    $rows[] = $r;
}
$data ="(Data:".json_encode($rows).")";
echo $data;
?>


//LISTITEM.xml
<?xml version="1.0" encoding="utf-8"?>
<LinearLayout xmlns:android="http://schemas.android.com/apk/res/android"
   android:orientation="vertical" android:layout_width="match_parent"
   android:layout_height="match_parent">
 
    <TextView
       android:layout_width="match_parent"
       android:layout_height="73dp"
       android:id="@+id/tx_name"
       android:layout_alignParentLeft="true"
       android:text=""
       android:gravity="center"
       android:textAppearance="?android:textAppearanceLarge"
       android:background="@color/accent_material_dark" />
 
    <TextView
       android:layout_width="match_parent"
       android:layout_height="85dp"
       android:id="@+id/tx_brg"
       android:layout_toRightOf="@+id/tx_name"
       android:text=""
       android:gravity="center"
       android:textAppearance="?android:textAppearanceLarge"
       />
    <TextView
       android:layout_width="match_parent"
       android:layout_height="92dp"
       android:id="@+id/tx_harga"
       android:layout_toRightOf="@+id/tx_brg"
       android:text=""
       android:gravity="center"
       android:textAppearance="?android:textAppearanceLarge"
       />
 
</LinearLayout>


//View List.XML
<?xml version="1.0" encoding="utf-8"?>
<LinearLayout xmlns:android="http://schemas.android.com/apk/res/android"
   android:orientation="vertical" android:layout_width="match_parent"
   android:layout_height="match_parent">
 
 
    <ListView
       android:layout_width="match_parent"
       android:layout_height="wrap_content"
       android:id="@+id/listview"
       android:layout_alignParentTop="true"
       android:layout_alignParentLeft="true"
       android:layout_alignParentStart="true" />
 
</LinearLayout>


//Activity Main.xml
<?xml version="1.0" encoding="utf-8"?>
<RelativeLayout
    xmlns:android="http://schemas.android.com/apk/res/android"
    xmlns:tools="http://schemas.android.com/tools"
    android:layout_width="match_parent"
    android:layout_height="match_parent"
    android:paddingLeft="@dimen/activity_horizontal_margin"
    android:paddingRight="@dimen/activity_horizontal_margin"
    android:paddingTop="@dimen/activity_vertical_margin"
    android:paddingBottom="@dimen/activity_vertical_margin"
    tools:context="com.example.creative.final_tugas.MainActivity">
 
 
    <LinearLayout
        android:orientation="vertical"
        android:layout_width="match_parent"
        android:layout_height="match_parent"
        android:weightSum="1">
 
        <Button
            android:layout_width="fill_parent"
            android:layout_height="wrap_content"
            android:text="Get JSON"
            android:onClick="getJSON"
            android:id="@+id/b1"
            android:layout_gravity="center_horizontal" />
 
        <Button
            android:layout_width="fill_parent"
            android:layout_height="wrap_content"
            android:text="Parse JSON"
            android:onClick="parseJSON"
            android:id="@+id/b2"
            android:layout_gravity="center_horizontal" />
 
        <TextView
            android:layout_width="364dp"
            android:layout_height="wrap_content"
            android:text=""
            android:id="@+id/textView"
            android:layout_gravity="center_vertical"
            android:layout_weight="0.31" />
    </LinearLayout>
</RelativeLayout>

//===============================================
//Main_activity.java
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
 
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
 
    public class MainActivity extends AppCompatActivity {
        String JSON_STRING;
        String json_string;
 
        private static final String json_url="http://192.168.43.36/dagang/Servis.php";
        @Override
        protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_main);
        }
        public void getJSON(View view)
        {
            new BackroadTask().execute();
        }
        class BackroadTask extends AsyncTask<Void,Void,String>
        { ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(MainActivity.this, "Please Wait...",
                        null, true, true);
            }
 
            @Override
            protected String doInBackground(Void... params) {
                try {
                    URL url = new URL(json_url);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                    StringBuilder stringBuilder = new StringBuilder();
 
                    while ((JSON_STRING= bufferedReader.readLine())!=null)
                    {
                        stringBuilder.append(JSON_STRING+"\n");
 
                    }
                    bufferedReader.close();
                    inputStream.close();
                    httpURLConnection.disconnect();
                    return stringBuilder.toString().trim();
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
                return null;
            }
 
            @Override
            protected void onProgressUpdate(Void... values) {
                super.onProgressUpdate(values);
            }
 
            @Override
            protected void onPostExecute(String result) {
                TextView textView = (TextView)findViewById(R.id.textView);
                textView.setText(result);
                json_string = result;
 
            }
        }
 
        public void parseJSON(View view)
        {
            if(json_string ==null)
            {
                Toast.makeText(getApplicationContext(),"Try Again, Please Click GET JSON", Toast.LENGTH_LONG).show();
            }
            else
            {
                Toast.makeText(getApplicationContext(),"Proses....", Toast.LENGTH_LONG).show();
                Intent intent = new Intent(this,viewlist_item.class);
                intent.putExtra("json_data",json_string);
                startActivity(intent);
 
            }
        }
        @Override
        public boolean onCreateOptionsMenu(Menu menu) {
            // Inflate the menu; this adds items to the action bar if it is present.
            getMenuInflater().inflate(R.menu.menu_main, menu);
            return true;
        }
 
        @Override
        public boolean onOptionsItemSelected(MenuItem item) {
            // Handle action bar item clicks here. The action bar will
            // automatically handle clicks on the Home/Up button, so long
            // as you specify a parent activity in AndroidManifest.xml.
            int id = item.getItemId();
 
            //noinspection SimplifiableIfStatement
            if (id == R.id.action_settings) {
                return true;
            }
 
            return super.onOptionsItemSelected(item);
        }
    }
    
    
===============================================
//view_list_item.java
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
 
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
 
/**
 * Created by SAMSUNG on 19/06/2016.
 */
public class viewlist_item extends AppCompatActivity {
    String json_string;
    JSONObject jsonObject;
    JSONArray jsonArray;
    ContactAdapter contactAdapter;
    ListView listView;
 
 
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.view_list);
        listView = (ListView)findViewById(R.id.listview);
        contactAdapter = new ContactAdapter(this,R.layout.list_item);
        listView.setAdapter(contactAdapter);
        json_string = getIntent().getExtras().getString("json_data");
        try {
            jsonObject = new JSONObject(json_string);
            jsonArray = jsonObject.getJSONArray("result");
            int count = 0;
            String kode,nama,harga;
            while(count<jsonArray.length())
            {
                JSONObject JO = jsonArray.getJSONObject(count);
                kode = JO.getString("KodeBarang");
                nama = JO.getString("NamaBarang");
                harga = JO.getString("HargaSatuan");
                Contacts contacts= new Contacts(kode,nama,harga);
                contactAdapter.add(contacts);
 
                count++;
 
            }
 
        } catch (JSONException e) {
            e.printStackTrace();
        }
 
 
    }
 
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.viewlist, menu);
        return true;
    }
 
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
 
        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }
 
        return super.onOptionsItemSelected(item);
    }
 
 
}    


==========================================
//contact.java
public class Contacts {
    private String KodeBarang,NamaBarang,HargaSatuan;
    public Contacts (String kode, String nama, String harga)
    {
        this.setKode(kode);
        this.setNama(nama);
        this.setHarga(harga);
    }
 
    public String getKode() {
        return KodeBarang;
    }
 
    public void setKode(String kode) {
        this.KodeBarang = kode;
    }
 
    public String getNama() {
        return NamaBarang;
    }
 
    public void setNama(String nama) {
        this.NamaBarang = nama;
    }
 
    public String getHarga() {
        return HargaSatuan;
    }
 
    public void setHarga(String harga) {
        this.HargaSatuan = harga;
    }
}


===================================
//contact_adapter.java
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;
 
import java.util.ArrayList;
import java.util.List;
 
public class ContactAdapter extends ArrayAdapter {
 
    List list = new ArrayList();
    public ContactAdapter(Context context, int resource) {
        super(context, resource);
    }
 
    @Override
    public void add(Object object)
    {
        super.add(object);
        list.add(object);
    }
 
    @Override
    public int getCount()
    {
        return list.size();
    }
 
    @Override
    public Object getItem(int position)
    {
        return list.get(position);
    }
 
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View row;
        row = convertView;
        ContactsHolder contactsHolder;
        if (row == null)
        {
            LayoutInflater layoutInflater = (LayoutInflater)this.getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            row = layoutInflater.inflate(R.layout.list_item,parent,false);
            contactsHolder = new ContactsHolder();
            contactsHolder.tx_kode =(TextView) row.findViewById(R.id.tx_name);
            contactsHolder.tx_nama =(TextView) row.findViewById(R.id.tx_brg);
            contactsHolder.tx_harga =(TextView) row.findViewById(R.id.tx_harga);
            row.setTag(contactsHolder);
 
        }
        else
        {
            contactsHolder = (ContactsHolder)row.getTag();
 
        }
        Contacts contacts = (Contacts)this.getItem(position);
        contactsHolder.tx_kode.setText(contacts.getKode());
        contactsHolder.tx_nama.setText(contacts.getNama());
        contactsHolder.tx_harga.setText(contacts.getHarga());
        return row;
    }
    static class ContactsHolder
    {
        TextView tx_kode, tx_nama,tx_harga;
    }
}



//android_manifest.XML
<?xml version="1.0" encoding="utf-8"?>
<manifest xmlns:android="http://schemas.android.com/apk/res/android"
   package="com.example.creative.final_tugas" >
    <uses-permission android:name="android.permission.INTERNET" />
    <application
       android:allowBackup="true"
       android:icon="@mipmap/ic_launcher"
       android:label="@string/app_name"
       android:supportsRtl="true"
       android:theme="@style/AppTheme" >
        <activity android:name=".MainActivity" >
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />
 
                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
        <activity
           android:name=".viewlist_item"
           android:label="@string/app_name" >
        </activity>
    </application>
 
</manifest>
