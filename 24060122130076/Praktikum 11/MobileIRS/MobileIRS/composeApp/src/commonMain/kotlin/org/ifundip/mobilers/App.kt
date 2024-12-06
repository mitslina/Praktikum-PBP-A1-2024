package org.ifundip.mobilers

import androidx.compose.runtime.Composable
import cafe.adriel.voyager.navigator.Navigator
import org.jetbrains.compose.ui.tooling.preview.Preview

@Composable
@Preview

fun App() {
    Navigator(
        screen = Login()
    )
}
//fun App() {
//    MaterialTheme {
//        var showContent by remember { mutableStateOf(false) }
//        Column(
//            modifier = Modifier
//                .fillMaxSize()
//                .padding(16.dp),
//            horizontalAlignment = Alignment.CenterHorizontally,
//            verticalArrangement = Arrangement.Center
//        ) {
//            Image(
//                painter = painterResource(Res.drawable.compose_multiplatform),
//                contentDescription = "Logo",
//                modifier = Modifier.size(150.dp)
//            )
//            Spacer(modifier = Modifier.height(32.dp))
//            var username = remember { TextFieldValue() }
//            BasicTextField(
//                value = username,
//                onValueChange = { username = it },
//                textStyle = TextStyle(fontWeight = FontWeight.Normal),
//                modifier = Modifier
//                    .fillMaxWidth()
//                    .border(1.dp, Color.Gray)
//                    .padding(16.dp),
//                decorationBox = { innerTextField ->
//                    Box(Modifier.padding(8.dp)) {
//                        if (username.text.isEmpty()) {
//                            Text("Username", style = TextStyle(color = Color.Gray))
//                        }
//                        innerTextField()
//                    }
//                }
//            )
//            Spacer(modifier = Modifier.height(16.dp))
//            var password = remember { TextFieldValue() }
//            BasicTextField(
//                value = password,
//                onValueChange = { password = it },
//                textStyle = TextStyle(fontWeight = FontWeight.Normal),
//                modifier = Modifier
//                    .fillMaxWidth()
//                    .border(1.dp, Color.Gray)
//                    .padding(16.dp),
//                visualTransformation = VisualTransformation.None,
//                decorationBox = { innerTextField ->
//                    Box(Modifier.padding(8.dp)) {
//                        if (password.text.isEmpty()) {
//                            Text("Password", style = TextStyle(color = Color.Gray))
//                        }
//                        innerTextField()
//                    }
//                }
//            )
//            Spacer(modifier = Modifier.height(32.dp))
//            Button(
//                onClick = { /* Handle sign in logic */ },
//                modifier = Modifier.fillMaxWidth()
//            ) {
//                Text("Sign In", modifier = Modifier.padding(8.dp))
//            }
//        }
//    }
//}